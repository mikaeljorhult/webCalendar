<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UsersTest extends TestCase
{
    use DatabaseMigrations, WithoutMiddleware;

    /**
     * Check that users index is available.
     *
     * @return void
     */
    public function testIndex()
    {
        $users = factory(\WebCalendar\User::class, 10)->create();

        $this->visit(route('admin.users.index'))
            ->seePageIs(route('admin.users.index'))
            ->see($users->first()->username);

        $this->assertResponseOk();
    }

    /**
     * Check that user can be edited from index page.
     *
     * @return void
     */
    public function testIndexEdit()
    {
        $user = factory(\WebCalendar\User::class, 1)->create();

        $this->visit(route('admin.users.index'))
            ->see($user->username)
            ->click(trans('messages.edit'))
            ->seePageIs(route('admin.users.edit', [$user]));

        $this->assertResponseOk();
    }

    /**
     * Check that user can be deleted from index page.
     *
     * @return void
     */
    public function testIndexDestroy()
    {
        $users = factory(\WebCalendar\User::class, 2)->create();
        $user = $users->last();

        $this->actingAs($users->first())
            ->visit(route('admin.users.index'))
            ->see($user->username)
            ->press(trans('messages.delete'))
            ->seePageIs(route('admin.users.index'))
            ->dontSee($user->username);

        $this->assertResponseOk();
    }

    /**
     * Check that single users view is available.
     *
     * @return void
     */
    public function testShow()
    {
        $user = factory(\WebCalendar\User::class, 1)->create();

        $this->visit(route('admin.users.show', [$user]))
            ->seePageIs(route('admin.users.show', [$user]))
            ->see($user->username);

        $this->assertResponseOk();
    }

    /**
     * Check that edit view is available.
     *
     * @return void
     */
    public function testEdit()
    {
        $user = factory(\WebCalendar\User::class, 1)->create();

        $this->visit(route('admin.users.edit', [$user]))
            ->seePageIs(route('admin.users.edit', [$user]))
            ->see($user->username);

        $this->assertResponseOk();
    }

    /**
     * Check that user can be updated.
     *
     * @return void
     */
    public function testUpdate()
    {
        $user = factory(\WebCalendar\User::class, 1)->create([
            'username' => 'Old username'
        ]);

        $this->visit(route('admin.users.edit', [$user]))
            ->seePageIs(route('admin.users.edit', [$user]))
            ->see($user->username)
            ->type('New username', 'username')
            ->press(trans('messages.update'))
            ->seePageIs(route('admin.users.index'))
            ->see('New username');

        $this->assertResponseOk();
    }

    /**
     * Check that user can be created.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->visit(route('admin.users.create'))
            ->type('New username', 'username')
            ->type('test@test.com', 'email')
            ->type('secret-password', 'password')
            ->press(trans('messages.create-user'))
            ->seePageIs(route('admin.users.index'))
            ->see('New username');

        $this->assertResponseOk();
    }
}
