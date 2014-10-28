<?php


class WebsiteNavApp extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_nav_apps';
    public function website() {
        return $this->belongsTo('Website');
    }
    public function test() {
        return $this->belongsTo('WebsiteApp');
    }
}