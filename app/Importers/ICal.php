<?php

namespace WebCalendar\Importers;

use Sabre\VObject\Reader;

class ICal extends Importer
{
    public function get()
    {
        // Try to fetch calendar.
        $response = $this->request();

        // Check that calendar was returned correctly.
        if ($response) {
            return $this->parse((string)$response->getBody());
        } else {
            // Log that retrieval of calendar failed.
            \Log::error('Couldn\'t retrieve iCal calendar for ' . $this->module->name . '.');
        }

        return false;
    }

    protected function parse($body)
    {
        if ($body) {
            $calendar = Reader::read($body, Reader::OPTION_FORGIVING)
                ->expand($this->module->start_date, $this->module->end_date);

            $lessons = [];

            // Add all events to array.
            if (count($calendar->VEVENT) > 0) {
                foreach ($calendar->VEVENT as $item) {
                    $lessons[] = [
                        'module_id' => $this->module->id,
                        'title' => substr((string)$item->SUMMARY, 0, 255),
                        'location' => substr((string)$item->LOCATION, 0, 50),
                        'description' => substr((string)$item->DESCRIPTION, 0, 255),
                        'start_time' => $item->DTSTART->getDateTime(),
                        'end_time' => $item->DTEND->getDateTime()
                    ];
                }
            }

            return $lessons;
        }

        return false;
    }
}