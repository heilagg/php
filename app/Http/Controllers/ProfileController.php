<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $name = "Malika Amirzhan";
        $age = 21;

        return view('profile', compact('name', 'age'));
    }
}
