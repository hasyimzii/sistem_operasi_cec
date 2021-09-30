<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::all();
        return view('product.index',compact('outlet'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $product = \App\Models\Product::where('outlet_id', $id)->get();
        return view('product.show',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $outlet = \App\Models\Outlet::all();
        $category = \App\Models\Category::all();
        return view('product.create',compact('outlet','category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'category_id' => 'required|numeric',
            'name' => 'required|string',
            'stock' => 'required|numeric',
            'price' => 'required|numeric|max:6',
            'description' => 'required|string',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return response()->json(['status' => false ,'message' => $validator->errors()->all()], 400);
        }

        $dataCreate = [
            'outlet_id' => $request->outlet_id,
            'category_id' => $request->category_id,
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
            'description' => $request->description,
        ];
        $product = \App\Models\Product::create($dataCreate);
        return response()->json(['status' => true ,'message' => 'Berhasil menambahkan data produk']);
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
        return view('product.edit',compact('product'));
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
            'price' => 'required|numeric|max:6',
            'description' => 'required|string',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return response()->json(['status' => false ,'message' => $validator->errors()->all()], 400);
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
                'outlet_id' => $user->outlet->id(),
                'description' => 'Mengubah data produk '. $request->name . 
                                ' stok: '. $request->stock .
                                ' harga: '. $request->price,
            ];
            $history = \App\Models\History::create($dataHistory);
        }

        return response()->json(['status' => true ,'message' => 'Berhasil memperbarui data produk']);
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
