<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $validated=$request->validated();
        if ($request->hasFile('pic')) {
            if ($user->pic) {
                Storage::disk('public')->delete($user->pic);
            }
            $picPath = $request->file('pic')->store('users', 'public');
            $validated['pic'] = $picPath;
        }
}
