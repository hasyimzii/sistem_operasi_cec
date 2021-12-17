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
        // check is active
        if($user->active == 1) {
            // check role return dashboard
            if ($user->hasRole('admin')) {
                return redirect()->route('sale.index');
            }
            else if ($user->hasRole('employee')) {
                return redirect()->route('sale.create', $user->outlet->id);
            }
            else {
                auth()->logout();
                return redirect()->route('login');
            }
        }
        // if not active
        auth()->logout();
        return redirect()->route('login')->with('error', 'Akun sudah tidak aktif!');;
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
            $history = \App\Models\History::all();
        }
        else {
            // $history = \App\Models\History::select('histories.*')
            //     ->join('users', 'users.id', '=', 'histories.user_id')
            //     ->join('outlets', 'outlets.id', '=', 'users.outlet_id')
            //     ->where('outlet_id', $outletId)->get();

            $history = \App\Models\History::whereHas('user', function($q) use ($user){
                $q->where('outlet_id', $user->outlet->id);
            })->get();
        }
        return view('home.history',compact('history'));
    }
}
