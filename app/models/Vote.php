<?php

class Vote extends Eloquent {
	protected $guarded = array();

	public static $rules = array();

	public $timestamps = false;

	/**
	 * Gets data about server for the vote
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function server() {
		return $this->belongsTo('Server');
	}
}