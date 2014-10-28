<?php


class Website extends \LaravelBook\Ardent\Ardent {

    protected $table = 'websites';
    public static $rules = array(
        'title'         =>  'required|min:15|max:70',
        'path'          =>  'required|min:3|max:15|alpha_dash',
        'paypal_email'  =>  'email|max:50',
        'email'         =>  'email|max:50'
    );
    public function  pages() {
        return $this->hasMany('WebsitePage');
    }
    public function  social() {
        return $this->hasOne('WebsiteSocial');
    }
    public function  navApps() {
        return $this->hasMany('WebsiteNavApp');
    }
}