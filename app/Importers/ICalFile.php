<?php

namespace WebCalendar\Importers;

use Sabre\VObject\Reader;

class ICalFile extends ICal
{
    public function request()
    {
        $contents = file_get_contents(storage_path('app/') . $this->url());

        if ($contents !== false) {
            return $contents;
        }

        return false;
    }

    public function get()
    {
        // Try to fetch calendar.
        $contents = $this->request();

        // Check that calendar was returned correctly.
        if ($contents) {
            return $this->parse($contents);
        } else {
            // Log that retrieval of calendar failed.
            \Log::error('Couldn\'t retrieve iCal file for ' . $this->module->name . '.');
        }

        return false;
    }
}