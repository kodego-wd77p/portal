<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getUserId(Request $request)
    {
        $user = Auth::user(); // Retrieve the currently authenticated user...
        $id = Auth::id(); // Retrieve the currently authenticated user's ID...


        $user = $request->user(); // returns an instance of the authenticated user...
        $id = $request->user()->id; // Retrieve the currently authenticated user's ID...


        $user = auth()->user(); // Retrieve the currently authenticated user...
        $id = auth()->id();  // Retrieve the currently authenticated user's ID...
    }
}
