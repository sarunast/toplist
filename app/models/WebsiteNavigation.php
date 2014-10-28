<?php


class WebsiteNavigation extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_navigations';

    public function page() {
        return $this->belongsTo('WebsitePage');
    }
}