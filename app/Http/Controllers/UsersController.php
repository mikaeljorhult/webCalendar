<?php

namespace WebCalendar\Http\Controllers;

use WebCalendar\Http\Requests\UserCreateRequest;
use WebCalendar\Http\Requests\UserDeleteRequest;
use WebCalendar\Http\Requests\UserUpdateRequest;
use WebCalendar\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return Response
     */
    public function store(UserCreateRequest $request)
    {
        User::create($request->all());

        return redirect()->route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user)
    {
        return view('users.show')
            ->with('user', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     */
    public function edit(User $user)
    {
        return view('users.edit')
            ->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param User $user
     * @param UserUpdateRequest $request
     * @return Response
     */
    public function update(User $user, UserUpdateRequest $request)
    {
        $user->update($request->all());

        return redirect()->route('admin.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @param UserDeleteRequest $request
     * @return Response
     */
    public function destroy(User $user, UserDeleteRequest $request)
    {
        $user->delete();

        return redirect()->route('admin.users.index');
    }
}