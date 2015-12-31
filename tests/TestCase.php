<?php

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

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
        $mock = new MockHandler($responses);
        $handler = HandlerStack::create($mock);
        $client = new Client(['handler' => $handler]);

        // Replace Guzzle with mock in service container.
        app()->instance('\GuzzleHttp\Client', $client);
    }
}
