<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function create()
    {
        return response()->view('users.create');
    }
    public function store(UserRequest $userRequest)
    {
        $validatedData = $userRequest->validated();
        $validatedData['password'] = Hash::make($userRequest->NIM);
        $user = User::create($validatedData);
        event(new Registered($user));
        return redirect()->route('admin.users.index');
    }
    public function destroy(User $user)
    {
        User::destroy($user->id);
        return redirect()->route('admin.users.index');
    }
}
