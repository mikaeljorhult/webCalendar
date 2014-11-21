<?php namespace WebCalendar;

use \GuzzleHttp\Client;

class Calendar {
	private $module;
	
	public function __construct( $module ) {
		$this->module = $module;
	}
	
	public function get() {
		$client = new Client();
		
		// Try to fetch calendar.
		$response = $client->get( $this->module->url, [ 'exceptions' => false ] );
		
		// Check that calendar was returned correctly.
		if ( $response->getStatusCode() === 200 ) {
			return $response->json();
		} else {
			// Log that retrieval of calendar failed.
			\Log::error( 'Couldn\'t retrieve calendar for ' . $this->module->name . '.' );
		}
		
		return false;
	}
}