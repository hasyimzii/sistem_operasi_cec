<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
        return view('report.index',compact('outlet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function outlet($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $sale = \App\Models\Sale::where("outlet_id", $outlet->id)->get();
        $expense = \App\Models\Expense::where("outlet_id", $outlet->id)->get();


        $totalSale = 0;
        // looping sale
        foreach($sale as $data) {
            $order = $data->order;
            $totalOrder = 0;
            // looping order
            foreach($order as $or) {
                $result = $or->amount * $or->price;
                // insert result to totalOrder
                $totalOrder += $result;
            }
            // insert total per order to totalSale
            $totalSale += $totalOrder;
        }
        
        $totalExpense = 0;
        // foreach($expense as $data) {

        // }
        return view('report.outlet',compact('outlet','totalSale','totalExpense'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $expense = \App\Models\Expense::where("outlet_id", $outlet->id)->get();
        $sale = \App\Models\Sale::where("outlet_id", $outlet->id)->get();
        return view('report.show',compact('outlet','report'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recap()
    {
        $expense = \App\Models\Expense::where("outlet_id", $outlet->id)->get();
        $sale = \App\Models\Sale::where("outlet_id", $outlet->id)->get();
        return view('report.recap',compact('outlet','report'));
    }
}
