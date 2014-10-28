<?php

class VoteController extends \BaseController {

	public function index($id)
	{

        $this->website->scripts = array('vote');
		return View::make('vote')
            ->with('server', Server::findOrFail($id));
	}


	public function store($id)
	{

		//VARIABLES
		$votes_per_ip = 1;
		$fingerprint = Input::get('fingerprint');
		$ip = Request::getClientIp();
		$cookie = Cookie::make($id, 'yes', 1440); //24h
		$failed_redirect = Redirect::to('vote/'.$id);

		//check the cookie 1st
/*		if(Cookie::get($id)){
			//cookie already exists
			return $failed_redirect
                ->with('flash_notice','You have already voted today');
		}*/

		//times allowed to vote from same ip
		if(Vote::where('ip', $ip)
                ->where('server_id', $id)
                ->count() >= $votes_per_ip){
			//IP already has the maximum set votes
			return $failed_redirect
                ->with('flash_notice','You have already voted today');
		};

		//check the browser fingerprint
		if(Vote::where('fingerprint', $fingerprint)
            ->where('server_id', $id)
			->count() >= $votes_per_ip){
			//the same fingerprint was found
			return $failed_redirect
                ->with('flash_notice','You have already voted today');
		}

		$rules = array(
			'recaptcha_response_field' => 'required|recaptcha',
			'fingerprint' => 'alpha_num|required',
		);

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->passes()) {
            $server = Server::findOrFail($id);
            $server->increment('votes');
            $server->increment('day_votes');
            $server->save();

			$vote = new Vote;
			$vote->server_id = $id;
			$vote->ip = $ip;
			$vote->fingerprint = $fingerprint;
			$vote->save(); //save new vote


            return Redirect::to('/')
				->with('flash_notice','Your vote has been accepted. Thank you for voting.');
        }
        return Redirect::to('vote/'.$id)->withErrors($validator);
    }

}