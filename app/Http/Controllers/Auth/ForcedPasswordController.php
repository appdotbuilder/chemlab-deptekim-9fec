<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ForcedPasswordController extends Controller
{
    /**
     * Update the user's password when forced to change it.
     */
    public function update(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()],
        ]);

        $user = $request->user();
        $user->forceFill([
            'password' => Hash::make($request->password),
            'must_change_password' => false,
        ])->save();

        return redirect()->intended('/dashboard')->with('success', 'Password berhasil diperbarui.');
    }
}