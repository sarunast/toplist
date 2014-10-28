<?php


class WebsiteSocial extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_socials';
    public static $rules = array(
        'facebook'     =>  'min:5|max:100',
        'gplus'     =>  'min:5|max:100',
        'twitter'     =>  'min:5|max:100'
    );
    public function website() {
        return $this->belongsTo('Website');
    }
}