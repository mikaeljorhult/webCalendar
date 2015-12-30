<?php

namespace WebCalendar\Console\Commands;

use Illuminate\Console\Command;
use WebCalendar\Module;

class FetchCalendarsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'calendars:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and save calendars for active modules.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Fetching all active modules.');

        // Get all active modules.
        $modules = Module::active()->get();

        // Go through and retrieve all found modules.
        if (count($modules) > 0) {
            foreach ($modules as $module) {
                $this->line('Updating module: ' . $module->name . '...');
                $module->retrieve();
            }

            $this->info('Updated ' . count($modules) . ' modules.');
        } else {
            $this->info('No modules to update.');
        }
    }
}
