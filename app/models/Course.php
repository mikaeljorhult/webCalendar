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
			return $this
				->belongsToMany( 'Module' )
				->withPivot( 'sort_order' )
				->orderBy( 'sort_order', 'ASC' );
		}
		
		public function scopeActive( $query ) {
			$modules = Module::with( 'courses' )
				->active()
				->get();
			
			$ids = [ 0 ];
			
			if ( count( $modules ) > 0 ) {
				foreach( $modules as $module ) {
					$ids = array_merge( $ids, $module->courses->lists( 'id' ) );
				}
			}
			
			return $query->with( 'modules' )->whereIn( 'id', array_unique( $ids ) );
		}
	}
?>