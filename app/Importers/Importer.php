<?php

namespace WebCalendar\Importers;

use \GuzzleHttp\Client;
use \DateTime;

class Importer
{
    protected $module;

    public function __construct($module)
    {
        $this->module = $module;
    }

    protected function url()
    {
        return $this->module->calendar;
    }

    protected function request()
    {
        $client = new Client();
        $response = $client->get($this->url(), ['exceptions' => false]);

        if ($response->getStatusCode() === 200) {
            return $response;
        }

        return false;
    }

    public function test()
    {
        return $this->request() !== false;
    }
}