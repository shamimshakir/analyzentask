<?php

namespace App\Http\Controllers;

use App\Contracts\UserServiceInterface;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        protected UserServiceInterface $service
    ){}

    /**
     * Display a listing of the users.
     */
    public function index(): View
    {
        $users = $this->service->index();
        return view('users.users', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in database.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->service->store($request->validated());
        return redirect()->route('users.create')->with('status', 'saved');
    }

    /**
     * Display the specified user.
     */
    public function show(string $id): View
    {
        $user = $this->service->singleUser($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id): View
    {
        $user = $this->service->singleUser($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $this->service->update($request->validated(), $id);
        return redirect()->route('users.edit', $id)->with('status', 'updated');
    }

    /**
     * Soft delete a user.
     */
    public function trash(string $id): RedirectResponse
    {
        $this->service->trash($id);
        return redirect()->route('users.index')->with('status', 'deleted');
    }

    /**
     * Retrieve Soft deleted users.
     */
    public function trashed(): View
    {
        $users = $this->service->trashed();
        return view('users.trashed', compact('users'));
    }

    /**
     * Restore a soft deleted user
     */
    public function restore(string $id): RedirectResponse
    {
        $this->service->restore($id);
        return redirect()->route('users.index')->with('status', 'restored');
    }

    /**
     * Permanently delete a user.
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->service->destroy($id);
        return redirect()->route('users.trashed')->with('status', 'deleted');
    }
}
