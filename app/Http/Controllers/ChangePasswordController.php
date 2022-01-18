<?php

namespace App\Http\Controllers;

use \Illuminate\Http\RedirectResponse;
use Auth;
use Hash;
use Symfony\Component\HttpFoundation\Request;

class ChangePasswordController extends Controller
{
    public function handle(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed'
        ]);

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->withErrors([
                'old_password' => 'password not match'
            ]);
        }

        $user->password = Hash::make($request->password);

        $user->save();

        return redirect()->back()->with('success', 'password successfully updated');
    }

}
