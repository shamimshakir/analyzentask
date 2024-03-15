<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        
    ){}

    /**
     * Display a listing of the users.
     */
    public function index(): View
    {
        $users = User::query()
            ->select('id','first_name', 'last_name', 'email', 'phone', 'photo')
            ->get();
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
        $validated = $request->validated();

        if($request->hasFile('photo')) {
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('images'), $imageName);
            $validated['photo'] = $imageName;
        }

        $validated['password'] = Hash::make($validated['password']);
        User::query()->create($validated);

        return redirect()->route('users.create')->with('status', 'saved');
    }

    /**
     * Display the specified user.
     */
    public function show(string $id): View
    {
        $user = User::query()->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(string $id): View
    {
        $user = User::query()->find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $validated = $request->validated();
        $user = User::query()->find($id);

        if($request->hasFile('photo')) {
            unlink(public_path('images/' . $user->photo));
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('images'), $imageName);
            $validated['photo'] = $imageName;
        }

        $user->update($validated);

        return redirect()->route('users.edit', $user->id)->with('status', 'updated');
    }

    /**
     * Soft delete a user.
     */
    public function trash(string $id): RedirectResponse
    {
        $user = User::query()->find($id);
        $user->delete();
        return redirect()->route('users.index')->with('status', 'deleted');
    }

    /**
     * Retrieve Soft deleted users.
     */
    public function trashed(): View
    {
        $users = User::onlyTrashed()
            ->select('id','first_name', 'last_name', 'email', 'phone', 'photo')
            ->get();
        return view('users.trashed', compact('users'));
    }

    /**
     * Restore a soft deleted user
     */
    public function restore(string $id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);
        $user->restore();
        return redirect()->route('users.index')->with('status', 'restored');
    }

    /**
     * Permanently delete a user.
     */
    public function destroy(string $id): RedirectResponse
    {
        $user = User::onlyTrashed()->find($id);
        $user->forceDelete();
        return redirect()->route('users.trashed')->with('status', 'deleted');
    }
}
