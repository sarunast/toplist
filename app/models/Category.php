<?php


class Category extends Eloquent {

    protected $table = 'categories';
    public function subcategories() {
        return $this->hasMany('Subcategory');
    }

}