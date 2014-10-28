<?php


class WebsiteContent extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_contents';
    public static $rules = array(
        'content'         =>  'required|min:5',
        'title'          =>  'required|min:5|max:100',
        'website_page_id'  =>  'required|numeric'
    );
    public function website() {
        return $this->belongsTo('WebsitePage');
    }
}