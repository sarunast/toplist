<?php

class PanelController extends \BaseController {

    public function panel()
    {
        return View::make('panel');
    }

    public function statistics()
    {
        $this->addCssJs('statistics'); // add custom class

        return View::make('panel.statistics')
            ->with('servers', Server::where('user_id', Auth::user()->id)->get());
    }

    public function createFinal()
    {
        if (!Session::has('server')){
            App::abort(404);
        }
        return View::make('panel.top.finish')->with('server',Session::get('server'));
    }


}