<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Check that front page is available.
     *
     * @return void
     */
    public function testFrontPage()
    {
        $this->visit('/')
             ->see('webCalendar');
    }
}
