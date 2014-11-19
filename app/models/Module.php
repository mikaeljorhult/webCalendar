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
			// Put togheter URL to call.
			$endpoint = 'https://www.googleapis.com/calendar/v3/calendars/' . $this->calendar . '/events?singleEvents=true&timeMin=' .  $this->start_date . 'T00:00:00.000Z&timeMax=' . $this->end_date . 'T23:59:59.000Z&orderBy=startTime&maxResults=500&key=' . getenv( 'API_KEY' );
			$json = [];
			$client = new GuzzleHttp\Client();
			
			// Try to fetch calendar.
			$response = $client->get( $endpoint, [ 'exceptions' => false ] );
			
			// Check that calendar was returned correctly.
			if ( $response->getStatusCode() === 200 ) {
				$json = $response->json();
			} else {
				// Log that retrieval of calendar failed.
				Log::error( 'Couldn\'t retrieve calendar for ' . $this->name . ': ' . $endpoint );
			}
			
			// Proceed if file was downloaded and parsed correctly.
			if ( $json ) {
				// Proceed if calendar has been updated since last retrieval.
				if ( strtotime( $json[ 'updated' ] ) > strtotime( $this->updated_at ) ) {
					$lessons = array();
					
					// Add all events to array.
					foreach ( $json[ 'items' ] as $item ) {
						$lessons[] = array(
							'module_id' => $this->id,
							'title' => isset( $item[ 'summary' ] ) ? substr( $item[ 'summary' ], 0, 255 ) : '',
							'location' => isset( $item[ 'location' ] ) ? substr( $item[ 'location' ], 0, 50 ) : '',
							'description' => isset( $item[ 'description' ] ) ? substr( $item[ 'description' ], 0, 255 ) : '',
							'start_time' => isset( $item[ 'start' ][ 'dateTime' ] ) ? new DateTime( $item[ 'start' ][ 'dateTime' ] ) : new DateTime( $item[ 'start' ][ 'date' ] . 'T00:00:00' ),
							'end_time' => isset( $item[ 'end' ][ 'dateTime' ] ) ? new DateTime( $item[ 'end' ][ 'dateTime' ] ) : new DateTime( $item[ 'start' ][ 'date' ] . 'T00:00:00' )
						);
					}
					
					// Delete previously stored lessons.
					$this->lessons()->delete();
					
					// Insert newly retrieved lessons.
					if ( count( $lessons ) > 0 ) {
						DB::table( 'lessons' )->insert(
							$lessons
						);
					}
					
					// Set updated timestamp on module.
					$this->touch();
				}
			}
		}
	}
?>