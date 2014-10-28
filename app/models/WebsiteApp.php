<?php


class WebsiteApp extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_apps';
    public function  navapp() {
        return $this->hasOne('WebsiteNavApp');
    }
}