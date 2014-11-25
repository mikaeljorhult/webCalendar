<?php

use WebCalendar\GoogleCalendar as Calendar;

/**
 * Database model for Module object.
 */
class Module extends BaseModel {
	public $timestamps = false;
	protected $fillable = [ 'course_id', 'name', 'short_name', 'start_date', 'end_date', 'calendar' ];
	public static $rules = [
		'name' => [ 'required' ],
		'start_date' => [ 'required', 'date' ],
		'end_date' => [ 'required', 'date' ],
		'calendar' => [ 'required' ]
	];
	public static $niceNames = [
		'name' => 'namn',
		'start_date' => 'startdatum',
		'end_date' => 'slutdatum',
		'calendar' => 'kalender'
	];
	
	/**
	 * Return the parent course.
	 * 
	 * @return Course
	 */
	public function courses() {
		return $this->belongsToMany( 'Course' );
	}
	
	/**
	 * Return lessons attached to module.
	 * 
	 * @return array
	 */
	public function lessons() {
		return $this->hasMany( 'Lesson' );
	}
	
	public function scopeActive( $query ) {
		$today = new DateTime( 'today' );
		
		return $query->where( 'start_date', '<=', $today->format( 'Y-m-d H:i:s' ) )
			->where( 'end_date', '>=', $today->format( 'Y-m-d H:i:s' ) );
	}
	
	/**
	 * Retrieve and parse calendar feed.
	 * 
	 * @return void
	 */
	public function retrieve() {
		// Get requested calendar.
		$calendar = new Calendar( $this );
		$items = $calendar->get();
		
		// Only proceed if fetch was successful.
		if ( $items !== false ) {
			// Delete previously stored lessons.
			$this->lessons()->delete();
			
			// Insert newly retrieved lessons.
			if ( count( $items ) > 0 ) {
				DB::table( 'lessons' )->insert(
					$items
				);
			}
			
			// Set updated timestamp on module.
			$this->touch();
		}
	}
}