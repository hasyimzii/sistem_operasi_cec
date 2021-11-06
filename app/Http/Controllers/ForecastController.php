<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ForecastController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
        return view('forecast.index',compact('outlet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $stock = \App\Models\Stock::where('outlet_id', $id)->where('amount', '>', 0)->get();
        return view('forecast.list',compact('outlet','stock'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getTotalSales($order)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $order = \App\Models\Order::select(DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m') month"))
        ->join('sales', 'sales.id', '=', 'orders.sale_id')
        ->where('outlet_id', $outlet->id)
        ->groupBy('month')->get();

        return $order;
    }

    /**
     * Show the application dashboard.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getPeriode($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $order = \App\Models\Order::select(DB::raw("DATE_FORMAT(orders.created_at, '%Y-%m') month"))
        ->join('sales', 'sales.id', '=', 'orders.sale_id')
        ->where('outlet_id', $outlet->id)
        ->groupBy('month')->get();

        return $order;
    }

    /**
     * Show the application dashboard.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function result(Request $request, $id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $stock = \App\Models\Stock::findOrFail($request->stock_id);
        $order = \App\Models\Order::select('orders.*')
            ->where('stock_id', $stock->id)
            ->join('sales', 'sales.id', '=', 'orders.sale_id')
            ->where('outlet_id', $outlet->id)->get();

        $totalSales = $this->getTotalSales($order);
        $periode = $this->getPeriode($outlet->id);
        
        $beta = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9];
        return view('sale.index',compact('outlet','stock'));
    }
}
