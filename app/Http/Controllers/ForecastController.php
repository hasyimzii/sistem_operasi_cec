<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ForecastController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $product = \App\Models\Product::all();
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
        return view('sale.index',compact('product','outlet'));
    }

    /**
     * Show the application dashboard.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPenjualan($request)
    {
        
        return view('sale.index',compact('product','outlet'));
    }
}
