<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AdminTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Check that admin page isn't available for visitors.
     *
     * @return void
     */
    public function testAdminPage()
    {
        // Visitors should be redirected to login when trying to go to admin.
        $this->visit('/admin')
            ->seePageIs('/auth/login');
    }

    /**
     * Check that admin page is available for users.
     *
     * @return void
     */
    public function testAdminPageForUser()
    {
        // Logged in users should be able to visit admin.
        $user = factory(\WebCalendar\User::class)->create();

        $this->actingAs($user)
            ->visit('/admin')
            ->seePageIs('/admin');

        $this->assertResponseOk();
    }
}
