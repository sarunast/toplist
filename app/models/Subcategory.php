<?php


class Subcategory extends Eloquent {

    protected $table = 'subcategories';
    public function category() {
        return $this->belongsTo('Category');
    }
    public function servers() {
        return $this->hasMany('Server');
    }

}