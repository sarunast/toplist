<?php


class Server extends Eloquent {

    protected $table = 'servers';
    public function subcategory() {
        return $this->belongsTo('Subcategory');
    }


	public function setUrlAttribute($value)
	{
		$this->attributes['url'] = strtolower($value);
	}
    public function  websiteServer() {
        return $this->hasOne('WebsiteServer');
    }

}