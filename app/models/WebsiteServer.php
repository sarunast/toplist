<?php


class WebsiteServer extends \LaravelBook\Ardent\Ardent {

    protected $table = 'website_servers';
    public static $rules = array(
        'server_id'     =>  'numeric'
    );
    public function server() {
        return $this->belongsTo('Server');
    }
}