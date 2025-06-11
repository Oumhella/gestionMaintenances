<?php

//// app/Http/Controllers/DashboardController.php
//namespace App\Http\Controllers;
//
//use Illuminate\Support\Facades\Auth;
//
//class DashboardController extends Controller
//{
//    public function index()
//    {
//        $user = Auth::user(); // Get the authenticated user
//        $username = $user->name; // Retrieve the username
//
//        return view('dashboard', compact('username'));
//    }
//}
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = auth()->user();
        return view('dashboard', compact('user'));
    }
}