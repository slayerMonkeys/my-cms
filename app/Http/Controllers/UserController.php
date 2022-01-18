<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;

class UserController extends Controller
{
    public function index()
    {
        //
    }

    public function showProfile()
    {
        $user = Auth::user();
        return view('admin.users.profile', compact("user"));
    }
}
