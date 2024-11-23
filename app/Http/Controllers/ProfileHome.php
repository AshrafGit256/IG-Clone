<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileHome extends Controller
{
    public function show($user)
    {
        // Pass user data to the view
        return view('profile.home', ['user' => $user]);
    }
}

