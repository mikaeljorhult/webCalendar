<?php
	/**
	 * Database model for Course object.
	 */
	class Course extends BaseModel {
		protected $fillable = [ 'name', 'code', 'start_date', 'end_date' ];
		public static $rules = [
			'name' => [ 'required' ],
			'code' => [ 'required', 'unique:courses' ],
			'start_date' => [ 'required', 'date' ],
			'end_date' => [ 'required', 'date' ]
		];
		
		public function modules() {
			return $this->hasMany( 'Module' );
		}
	}
?>