<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use AuthorizesRequests;
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update',$user);
        return view('users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('update',$user);
        $validated=$request->validated();
        if ($request->hasFile('pic')) {
            if ($user->pic) {
                Storage::disk('public')->delete($user->pic);
            }
            $picPath = $request->file('pic')->store('users', 'public');
            $validated['pic'] = $picPath;
        }
        $user->update($validated);
        return redirect()->back()->with('success', 'Vos informations personnelles ont été modifiées avec succès !');
    }
    public function resetPassword(ResetPasswordRequest $request){
        
        $validated=$request->validated();
        Auth::user()->update($validated);
        return redirect()->back()->with('success', 'Votre mot de passe a été mis à jour avec succès !');

    }
}
