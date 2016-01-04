<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * Check that users can log in and out.
     *
     * @return void
     */
    public function testLoginPage()
    {
        $user = factory(WebCalendar\User::class)->create([
            'password' => 'secret-password'
        ]);

        // Visitors should be redirected to login when trying to go to admin.
        $this->visit(route('admin'))
            ->seePageIs(route('login'))
            ->type($user->email, 'email')
            ->type('secret-password', 'password')
            ->press(trans('messages.login'))
            ->seePageIs(route('admin'))
            ->see(route('admin.courses.index'))
            ->click(trans('messages.logout'))
            ->seePageIs(route('home'))
            ->dontSee(route('admin.courses.index'));
    }
}
