<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return View::make('panel.login');
	}



	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $data = Input::all();
        $rules = array(
            'current_password' => 'required|min:5|max:100',
            'password' => 'required|confirmed|min:5|max:100',
        );
        $validator = Validator::make($data, $rules);
        if ($validator->passes()) {
            // Normally we would do something with the data.

            $user = User::find(Auth::user()->id);
            if (Hash::check($data["current_password"], $user->password))
            {
                $user->password = Hash::make($data["password"]);
                $user->save();
                return Redirect::to('panel/login')->with('flash_notice', 'Your password was changed.');
            }
            return Redirect::to('panel/login')->withErrors('Your current password is incorrect');
        }

        return Redirect::to('panel/login')->withErrors($validator);
	}



}