<?php

namespace App\Http\Controllers;

class AdminsController extends Controller
{
    public function index()
    {
        return view("admin.index");
    }
}
