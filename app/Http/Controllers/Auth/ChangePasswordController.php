<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\ChangePasswordRequest;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{

    public function edit(User $user)
    {
        $this->authorize('view', $user);
        return view('auth.passwords.change', compact('user'));
    }

    public function update(ChangePasswordRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->password = Hash::make($request->get('new_password'));
        $user->save();

        $redirect = Auth::user()->isAdmin() ? 'users.index' : 'dashboard';

        return redirect()->route($redirect)
            ->with('status', __('messages.password_change_status'));
    }
}
