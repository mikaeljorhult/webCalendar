<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class UpdateCalendarsCommand extends Command {
	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'update:calendars';
	
	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Fetch and update calendars.';
	
	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {
		$options = $this->option();
		$module_ids = [ 0 ];
		
		// Get all active modules if no are requested.
		if ( count( $options[ 'courses' ] ) == 0 && count( $options[ 'modules' ] ) == 0 ) {
			$this->info( 'Fetching all active modules.' );
			$modules = Module::active()->get();
		} else {
			$this->info( 'Fetching requested courses and modules.' );
			
			// Get all requested courses.
			$courses = Course::with( 'modules' )
				->whereIn( 'id', array_unique( array_merge( [ 0 ], $options[ 'courses' ] ) ) )
				->get();
			
			// Go through each course and all it's modules.
			foreach ( $courses as $course ) {
				$module_ids = array_merge( $module_ids, $course->modules()->lists( 'id' ) );
			}
			
			// Get all requested modules.
			$modules = Module::active()
				->whereIn( 'id', array_unique( array_merge( $module_ids, $options[ 'modules' ] ) ) )
				->get();
		}
		
		// Go through and retrieve all found modules.
		if ( count( $modules ) > 0 ) {
			foreach ( $modules as $module ) {
				$this->info( 'Updating module: ' . $module->name . '...' );
				$module->retrieve();
			}
			
			$this->info( 'Updated ' . count( $modules ) . ' modules.' );
		} else {
			$this->info( 'No modules to update.' );
		}
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions() {
		return [
			[ 'courses', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Courses to update.', null ],
			[ 'modules', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Modules to update.', null ]
		];
	}

}