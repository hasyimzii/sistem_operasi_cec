<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

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

    // periode var
    public $month = "01";
    public $year = "2000";

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function outlet($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $month = 1;
        $year = 2000;

        // set month name
        $list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthName = $list[$month - 1];
        
        $totalSale = 0;
        $totalExpense = 0;
        $totalAll = 0;
        return view('report.outlet',compact('outlet','monthName','year','totalSale','totalExpense','totalAll')); 
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function outletPeriode(Request $request, $id)
    {
        $month = $request->month;
        $year = $request->year;

        // set month name
        $list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthName = $list[$month - 1];

        $outlet = \App\Models\Outlet::findOrFail($id);
        $sale = \App\Models\Sale::where("outlet_id", $outlet->id)->whereMonth('created_at', '=', date($month))->whereYear('created_at', '=', date($year))->get();
        $expense = \App\Models\Expense::where("outlet_id", $outlet->id)->whereMonth('created_at', '=', date($month))->whereYear('created_at', '=', date($year))->get();

        // count report
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
        return view('report.outlet',compact('outlet','monthName','year','totalSale','totalExpense','totalAll')); 
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function recap()
    {
        $month = 1;
        $year = 2000;

        // set month name
        $list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthName = $list[$month - 1];
        
        $totalSale = 0;
        $totalExpense = 0;
        $totalAll = 0;
        return view('report.recap',compact('monthName','year','totalSale','totalExpense','totalAll')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function recapPeriode(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        // set month name
        $list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthName = $list[$month - 1];

        $expense = \App\Models\Expense::whereMonth('created_at', '=', date($month))->whereYear('created_at', '=', date($year))->get();
        $sale = \App\Models\Sale::whereMonth('created_at', '=', date($month))->whereYear('created_at', '=', date($year))->get();
        
        // set month name
        $list = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthName = $list[$month - 1];

        // count report
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
        return view('report.recap',compact('monthName','year','totalSale','totalExpense','totalAll'));
    }
}
