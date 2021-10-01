<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::all();
        return view('stock.index',compact('outlet'));
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
        $stock = \App\Models\Stock::where("outlet_id", $outlet->id)->get();
        return view('stock.list',compact('outlet','stock'));
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
        $product = \App\Models\Product::all();
        return view('stock.create',compact('outlet','product'));
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
            'product_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataCreate = [
            'outlet_id' => $request->outlet_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'active' => 1,
        ];

        if ($userRole == 'employee') {
            $product = \App\Models\Product::findOrFail($request->product_id);
            $dataHistory = [
                'user_id' => $user->id,
                'description' => 'Menambah data stok '. $product->name .
                                ' stok: '. $request->amount .
                                ' harga: '. $request->price,
            ];
            $history = \App\Models\History::create($dataHistory);
        }
        $stock = \App\Models\Stock::create($dataCreate);
        return back()->with('success', 'Berhasil menambahkan data stok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stock = \App\Models\Stock::findOrFail($id);
        return view('stock.show',compact('stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $stock = \App\Models\Stock::findOrFail($id);
        return view('stock.edit',compact('stock'));
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
        $stock = \App\Models\Stock::findOrFail($id);
        $input = $request->all();

        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'product_id' => 'required|numeric',
            'amount' => 'required|numeric',
            'price' => 'required|numeric',
            'active' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataUpdate = [
            'outlet_id' => $request->outlet_id,
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'price' => $request->price,
            'active' => $request->active,
        ];
        $stock->update($dataUpdate);

        if ($userRole == 'employee') {
            $product = \App\Models\Product::findOrFail($request->product_id);
            $dataHistory = [
                'user_id' => $user->id(),
                'description' => 'Mengubah data stok '. $product->name .
                                ' stok: '. $request->amount .
                                ' harga: '. $request->price,
            ];
            $history = \App\Models\History::create($dataHistory);
        }
        return back()->with('success', 'Berhasil memperbarui data stok');
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
