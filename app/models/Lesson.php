<?php

/**
 * Database model for Lesson object.
 */
class Lesson extends BaseModel {
	public $timestamps = false;
	protected $fillable = [ 'module_id', 'title', 'description', 'start_time', 'end_time' ];
	public static $rules = [];
	
	public function module() {
		return $this->belongsTo( 'Module' );
	}
}