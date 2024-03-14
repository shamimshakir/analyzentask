<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class UserController extends Controller
{
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
        $imageName = "";

        if($request->hasFile('photo')) {
            $imageName = time().'.'.$request->file('photo')->extension();
            $request->file('photo')->move(public_path('images'), $imageName);
        }

        $validated['password'] = Hash::make($validated['password']);
        $validated['photo'] = $imageName;
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
    public function update(Request $request, string $id)
    {
//        $product->update($request->validated());
//        return redirect()->route('products.index');
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
