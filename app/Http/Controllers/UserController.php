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
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $users = User::query()
            ->select('id','first_name', 'last_name', 'email', 'phone', 'photo')
            ->get();
        return view('users.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $user = User::query()->findOrFail($id);
        return view('users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
