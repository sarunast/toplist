<?php


class WebsitePage extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_pages';
    public static $rules = array(
        'website_app'     =>  'required',
        'name'      =>  'required|min:3|max:25'
    );
    public function website() {
        return $this->belongsTo('Website');
    }
    public function  navigation() {
        return $this->hasOne('WebsiteNavigation');
    }
    public function  content() {
        return $this->hasMany('WebsiteContent')->orderBy('created_at', 'DESC');
    }
}