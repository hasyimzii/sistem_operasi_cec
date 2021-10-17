<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
        return view('sale.index',compact('outlet'));
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
        $sale = \App\Models\Sale::where('outlet_id', $outlet->id)->get();
        return view('sale.list',compact('outlet','sale'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        $stock = \App\Models\Stock::where('active', 1)->where('amount', '!=', 0)->get();
        return view('sale.create',compact('outlet','stock'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $user = auth()->user();
        $userRole = $user->role->name;
        $input = $request->all();
        
        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'amount' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        // if stock not enough
        $stock = \App\Models\Stock::findOrFail($request->stock_id);
        if($request->amount > $stock->amount) {
            return back()->with('error', ['Stok produk tidak cukup!']);
        }

        $dataCreate = [
            'outlet_id' => $request->outlet_id,
            'stock_id' => $request->stock_id,
            'amount' => $request->amount,
        ];

        // employee history
        if ($userRole == 'employee') {
            // total price
            $totalPrice = $stock->price * $request->amount;
            $dataHistory = [
                'user_id' => $user->id,
                'category' => 'Penjualan',
                'description' => 'Melakukan penjualan produk '. $stock->product->name .
                                ' sebanyak: '. $request->amount .
                                ' total harga: '. $totalPrice,
            ];
            $history = \App\Models\History::create($dataHistory);
        }

        $sale = \App\Models\Sale::create($dataCreate);
        
        // decrease stock
        $decreasedStock = $stock->amount - $request->amount;
        $dataAmount = ['amount' => $decreasedStock];
        $stock->update($dataAmount);

        return back()->with('success', 'Berhasil menambah data penjualan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = \App\Models\Sale::findOrFail($id);
        $stock = \App\Models\Stock::where('active', 1)->where('amount', '!=', 0)->get();
        return view('sale.edit',compact('sale','stock'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = auth()->user();
        $userRole = $user->role->name;
        $sale = \App\Models\Sale::findOrFail($id);
        $input = $request->all();

        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'stock_id' => 'required|numeric',
            'amount' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataUpdate = [
            'outlet_id' => $request->outlet_id,
            'stock_id' => $request->stock_id,
            'amount' => $request->amount,
        ];
        $sale->update($dataUpdate);
        return back()->with('success', 'Berhasil memperbarui data penjualan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
