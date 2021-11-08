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
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function forecast($dataset)
    {
        $data = $dataset;
        $result = [];
        $beta = [0.1, 0.2, 0.3, 0.4, 0.5, 0.6, 0.7, 0.8, 0.9];
        return $result;
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

        // total sales orders grouped by month
        $totalSales = \App\Models\Order::selectRaw("DATE_FORMAT(orders.created_at, '%Y-%m') as periode, SUM(orders.amount * orders.price) as total")
            ->where('stock_id', $stock->id)
            ->join('sales', 'sales.id', '=', 'orders.sale_id')
            ->where('outlet_id', $outlet->id)
            ->groupBy('periode')->get();

        // all periode of sales
        $periode = \App\Models\Sale::selectRaw("DATE_FORMAT(sales.created_at, '%Y-%m') as periode")
            ->where('outlet_id', $outlet->id)
            ->groupBy('periode')->get();


        // sales per month for dataset
        $dataset = [];
        for($i=0; $i<count($periode); $i++) {
            for($j=0; $j<count($totalSales); $j++) {
                if($periode[$i]['periode'] == $totalSales[$j]['periode']){
                    $dataset[$i] = intval($totalSales[$j]['total']);
                    break;
                }else{
                    $dataset[$i] = 0;
                }
            }
        }

        // get periodes to array
        $month = [];
        foreach($periode as $data) {
            $month[] = $data['periode'];
        }

        // result
        $forecast = $this->forecast($dataset);
        $ingredient = \App\Models\Ingredient::where('product_id', $stock->product->id)->get();
        return view('forecast.result',compact('outlet','stock','month','dataset','forecast','ingredient'));
    }
}
