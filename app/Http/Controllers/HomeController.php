<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if($user->hasRole('admin')) {
            return view('home.admin');
            // return route('user.show');
        }
        else if($user->hasRole('employee')) {
            return view('home.employee');
            // return route('user.show');
        }
        else {
            return redirect('/login');
        }
    }
}
