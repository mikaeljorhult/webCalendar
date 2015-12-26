<?php

namespace WebCalendar\Importers;

use \DateTime;

class GoogleCalendar extends Importer
{
    protected function url()
    {
        $url = 'https://www.googleapis.com/calendar/v3/calendars/' . $this->module->calendar . '/events';
        $parameters = [
            'singleEvents' => 'true',
            'timeMin' => $this->module->start_date->format('Y-m-d') . 'T00:00:00.000Z',
            'timeMax' => $this->module->end_date->format('Y-m-d') . 'T23:59:59.000Z',
            'orderBy' => 'startTime',
            'maxResults' => '500',
            'key' => env('API_KEY')
        ];

        return $url . '?' . http_build_query($parameters);
    }

    public function get()
    {
        // Try to fetch calendar.
        $response = $this->request();

        // Check that calendar was returned correctly.
        if ($response) {
            return $this->parse($response->json());
        } else {
            // Log that retrieval of calendar failed.
            \Log::error('Couldn\'t retrieve Google calendar for ' . $this->module->name . '.');
        }

        return false;
    }

    private function parse($json)
    {
        if ($json) {
            $lessons = [];

            // Add all events to array.
            foreach ($json['items'] as $item) {
                $lessons[] = [
                    'module_id' => $this->module->id,
                    'title' => isset($item['summary']) ? substr($item['summary'], 0, 255) : '',
                    'location' => isset($item['location']) ? substr($item['location'], 0, 50) : '',
                    'description' => isset($item['description']) ? substr($item['description'], 0, 255) : '',
                    'start_time' => isset($item['start']['dateTime']) ? new DateTime($item['start']['dateTime']) : new DateTime($item['start']['date'] . 'T00:00:00'),
                    'end_time' => isset($item['end']['dateTime']) ? new DateTime($item['end']['dateTime']) : new DateTime($item['start']['date'] . 'T00:00:00')
                ];
            }

            return $lessons;
        }

        return false;
    }
}