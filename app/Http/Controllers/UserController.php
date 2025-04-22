<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('users.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|unique:users,email,'.$user->id,
            'current_password' => 'required_with:password|string',
            'password' => 'nullable|string|min:8|confirmed',
            'secret_question' => 'required|string',
            'secret_answer' => 'required|string',
        ]);

        // Verify current password if changing password
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['secret_answer'] = Hash::make($validated['secret_answer']);

        $user->update($validated);

        return redirect()->route('users.show')->with('success', 'Profile updated successfully!');
    }
}