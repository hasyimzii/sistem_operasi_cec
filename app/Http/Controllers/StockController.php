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
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
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
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        // check if stock is exist
        $stock = \App\Models\Stock::where("outlet_id", $request->outlet_id)->get();
        foreach($stock as $data) {
            if($data->product_id == $request->product_id) {
                return back()->with('error', ['Gagal, Stok sudah ada!']);
            }
        }
        
        $dataCreate = [
            'outlet_id' => $request->outlet_id,
            'product_id' => $request->product_id,
            'amount' => 0,
            'price' => 0,
        ];
        $stock = \App\Models\Stock::create($dataCreate);

        if ($userRole == 'employee') {
            $product = \App\Models\Product::findOrFail($request->product_id);
            $dataHistory = [
                'user_id' => $user->id,
                'category' => 'Stok',
                'description' => 'Menambah data stok '. $product->name,
            ];
            $history = \App\Models\History::create($dataHistory);
        }
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
            'product_id' => 'required|numeric',
            'old_amount' => 'required|numeric',
            'amount' => 'required|numeric',
            'old_price' => 'required|numeric',
            'price' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        // count new amount
        $new_amount = $request->old_amount + $request->amount;

        $dataUpdate = [
            'product_id' => $request->product_id,
            'amount' => ($request->amount == 0) ? $request->old_amount : $new_amount,
            'price' => ($request->price == 0) ? $request->old_price : $request->price,
        ];
        $stock->update($dataUpdate);

        // history
        $product = \App\Models\Product::findOrFail($request->product_id);
        // if not change price
        if($request->price == 0) {
            $dataHistory = [
                'user_id' => $user->id,
                'category' => 'Stok',
                'description' => 'Mengubah data stok '. $product->name .
                                 '<br> - stok: '. $new_amount,
            ];
        }
        // if change price
        else {
            $dataHistory = [
                'user_id' => $user->id,
                'category' => 'Stok',
                'description' => 'Mengubah data stok '. $product->name .
                                 '<br> - stok: '. $new_amount .
                                 '<br> - harga: '. $request->price,
            ];
        }
        $history = \App\Models\History::create($dataHistory);
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
