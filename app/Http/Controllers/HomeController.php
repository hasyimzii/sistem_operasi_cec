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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function history()
    {
        $user = auth()->user();
        $userRole = $user->role->name;
        if($userRole == 'admin') {
            $history = \App\Models\History::orderBy("created_at", "desc")->get();
        }
        else {
            $outletId = $user->outlet->id();
            $history = \App\Models\History::where('outlet_id', $outletId)->orderBy("created_at", "desc")->get();
        }
        return view('home.history',compact('history'));
    }
}
