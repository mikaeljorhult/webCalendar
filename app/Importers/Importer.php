<?php

namespace WebCalendar\Importers;

class Importer
{
    protected $client;
    protected $module;

    public function __construct($module, \GuzzleHttp\Client $client)
    {
        $this->module = $module;
        $this->client = $client;
    }

    protected function url()
    {
        return $this->module->calendar;
    }

    protected function request()
    {
        $response = $this->client->get($this->url(), ['exceptions' => false]);

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