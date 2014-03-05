<?php
	/**
	 * Database model for Course object.
	 */
	class Course extends BaseModel {
		protected $fillable = [ 'name', 'code' ];
		public static $rules = [
			'name' => [ 'required' ],
			'code' => [ 'required', 'unique:courses' ]
		];
		
		public function modules() {
			return $this->belongsToMany( 'Module' )->withPivot( 'sort_order' );
		}
	}
?>