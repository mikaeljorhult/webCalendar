<?php

namespace WebCalendar\Importers;

use Illuminate\Support\Facades\Storage;

class ICalFile extends ICal
{
    public function request()
    {
        if (Storage::has($this->url())) {
            return Storage::get($this->url());
        }

        return false;
    }

    public function get()
    {
        // Try to read calendar file.
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