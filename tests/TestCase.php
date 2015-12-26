<?php

use GuzzleHttp\Client;
use GuzzleHttp\Message\Response;
use GuzzleHttp\Subscriber\Mock;

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Mock Guzzle and setup HTTP responses.
     *
     * @param array $responses
     */
    protected function setHttpResponses(array $responses = [])
    {
        // Default to one response of 200 OK.
        if (count($responses) == 0) {
            $responses[] = new Response(200, []);
        }

        // Setup client and attach responses.
        $client = new Client();
        $mock = new Mock($responses);

        $client->getEmitter()->attach($mock);

        // Replace Guzzle with mock in service container.
        app()->instance('\GuzzleHttp\Client', $client);
    }
}
