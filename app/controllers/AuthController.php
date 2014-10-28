<?php

class AuthController extends \BaseController {

    private $user;

    /**
     * LOGIN
     */
    public function getLogin()
    {
        return View::make('auth.login');
    }

    public function postLogin()
    {
        $userdata = array(
            'username' => Input::get('username'),
            'password' => Input::get('password'),
        );
        $check = false;
        if (Input::get('remember')){
            $check = true;
        }
        if ( Auth::attempt($userdata,$check) )
        {
            // we are now logged in, go to home
            $websiteId = Website::where('user_id', Auth::user()->id)->first();
            if($websiteId){
                Session::put('website', $websiteId->id);

            }
            return Redirect::to('/')
                ->with('flash_notice', 'You have successfully logged in.');
        }
        else
        {
            // auth failure! lets go back to the login
            return Redirect::to('login')
                ->with('flash_error', 'Your username/password combination was incorrect.');
            // pass any error notification you want
            // i like to do it this way :)
        }
    }

    public function getLogout()
    {
        Auth::logout();
        Session::flush();
        return Redirect::to('/')
            ->with('flash_notice', 'You are successfully logged out.');
    }


    /**
     * REGISTER
     */

    public function getRegister()
    {
        return View::make('auth.register');
    }

    public function postRegister()
    {
        $data = Input::all();
        $rules = array(
            'username' => 'unique:users,username|required|alpha_num|min:4|max:32',
            'email' => 'unique:users,email|required|email|max:64',
            'password' => 'required|confirmed|min:5|max:20',
            'terms' => 'accepted',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            // Normally we would do something with the data.

            $user = new User;
            $user->username = $data["username"];
            if(isset($data["subscription"])){
              $user->subscription = $data["subscription"];
            }
            $user->email = $data["email"];
            $user->confirmation_code = md5(uniqid(mt_rand(), true));
            $user->password = Hash::make($data["password"]);
            $this->user = $user;
            $data = array('token'=>$user->confirmation_code,'username'=>$user->username);
            Mail::send('emails.auth.validation', $data, function($message)
            {
                $message->to($this->user->email, $this->user->username )->subject('Welcome!');
            });
            $user->save();

            return Redirect::to('/')->with('flash_notice','You successfully created new account. Please confirm your email.');
        }

        return Redirect::to('/register')->withErrors($validator)->withInput();
    }

    /**
     * REMIND PASSWORD
     */

    public function getRemind()
    {
        return View::make('auth.remind');
    }

    public function postRemind()
    {
        $credentials = array('email' => Input::get('email'));

        return Password::remind($credentials);
    }


    /**
     * RESET PASSWORD
     */

    public function getReset($token)
    {
        return View::make('auth.reset')->with('token', $token);
    }

    public function postReset($token)
    {
        //$credentials = array('email' => Input::get('email'));

        $email = DB::table('password_reminders')
            ->select('email')
            ->where('token', $token)
            ->pluck('email');

        if(!$email){
            return Redirect::to('reset/'.$token)
                ->with('reason', 'The token is invalid.');
        }

        //$user = User::where('email', $credentials->email)->first();

        return Password::reset(array('email' => $email), function($user, $password)
        {
            $user->password = Hash::make($password);

            $user->save();


            return Redirect::to('/')->with('flash_notice','Your password has been updated.');
        });
    }

    /**
     * VERIFY
     */

    public function getVerify($code)
    {
        $user = User::where('confirmation_code', $code)->where('confirmed',0)->firstOrFail();
        $user['confirmed'] = 1;
        $user->save();
        return Redirect::to('/')
            ->with('flash_notice','You email has been confirmed.');
    }

}