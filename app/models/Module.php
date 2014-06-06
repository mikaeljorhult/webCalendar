<?php
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
		 * Retrieve and parse calendar XML file.
		 * 
		 * @return void
		 */
		public function retrieve() {
			// Get calendar URL from database.
			$calendar = $this->calendar;
			
			// Retrieve calendar from source.
			$calendar = str_replace( '/basic', '/full?singleevents=true&start-min=' .  $this->start_date . '&start-max=' . $this->end_date . '&orderby=starttime', $calendar );
			$xml = false;
			
			// Fetch and parse XML.
			try {
				$xml = simplexml_load_file( $calendar );
			} catch( Exception $e ) {
				// Failed to parse XML file.
				Log::error( $e );
			}
			
			// Proceed if file was downloaded and parsed correctly.
			if ( $xml ) {
				// Proceed if calendar has been updated since last retrieval.
				if ( strtotime( $xml->updated ) > strtotime( $this->updated_at ) ) {
					$lessons = array();
					
					// Add all events to array.
					foreach ( $xml->entry as $entry ) {
						// Parse file according to namespace schema.
						$ns_gd = $entry->children( 'http://schemas.google.com/g/2005' );
						
						// Only add lessons with timestamps.
						if ( isset( $ns_gd->when ) ) {
							// Add to values to array.
							$lessons[] = array(
								'module_id' => $this->id,
								'title' => (string) $entry->title,
								'description' => (string) $entry->content,
								'start_time' => new DateTime( $ns_gd->when->attributes()->startTime ),
								'end_time' => new DateTime( $ns_gd->when->attributes()->endTime )
							);
						}
					}
					
					// Delete previously stored lessons.
					$this->lessons()->delete();
					
					// Insert newly retrieved lessons.
					DB::table( 'lessons' )->insert(
						$lessons
					);
				}
			}
			
			$this->touch();	
		}
	}
?>