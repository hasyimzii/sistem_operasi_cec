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
        $stock = \App\Models\Stock::where('outlet_id', $id)->get();
        return view('product.list',compact('product'));
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
        $category = \App\Models\Category::all();
        return view('product.create',compact('outlet','category'));
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
            'category_id' => 'required|numeric',
            'name' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataCreate = [
            'outlet_id' => $request->outlet_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
        ];

        if ($userRole == 'karyawan') {
            $dataHistory = [
                'user_id' => $user->id(),
                'description' => 'Menambah data produk '. $request->name . 
                                ' stok: '. $request->stock .
                                ' harga: '. $request->price,
            ];
            $history = \App\Models\History::create($dataHistory);
        }
        $product = \App\Models\Product::create($dataCreate);
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
        $product = \App\Models\Product::findOrFail($id);
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $outlet = $product->outlet();
        return view('product.edit',compact('product','outlet'));
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
        $product = \App\Models\Product::findOrFail($id);
        $input = $request->all();

        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'name' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric',
            'description' => 'required|string',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataUpdate = [
            'outlet_id' => $request->outlet_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
        ];
        $user->update($dataUpdate);

        if ($userRole == 'karyawan') {
            $dataHistory = [
                'user_id' => $user->id(),
                'description' => 'Mengubah data produk '. $request->name . 
                                ' stok: '. $request->stock .
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
