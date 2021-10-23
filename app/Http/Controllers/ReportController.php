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
        foreach($expense as $exp) {
            $result = $exp->amount * $exp->price;
            // insert result to totalExpense
            $totalExpense += $result;
        }

        $totalAll = $totalSale - $totalExpense;
        return view('report.outlet',compact('outlet','totalSale','totalExpense','totalAll'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function recap()
    {
        $expense = \App\Models\Expense::all();
        $sale = \App\Models\Sale::all();
        
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
        foreach($expense as $exp) {
            $result = $exp->amount * $exp->price;
            // insert result to totalExpense
            $totalExpense += $result;
        }
        
        $totalAll = $totalSale - $totalExpense;
        return view('report.recap',compact('totalSale','totalExpense','totalAll'));
    }
}
