<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class IngredientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = \App\Models\Product::all();
        return view('ingredient.index',compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        $ingredient = \App\Models\Ingredient::where("product_id", $product->id)->get();
        return view('ingredient.list',compact('product','ingredient'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $product = \App\Models\Product::findOrFail($id);
        return view('ingredient.create',compact('product'));
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
        $input = $request->all();

        $dataValidator = [
            'product_id' => 'required|numeric',
            'name' => 'required|string',
            'amount' => 'required|numeric|gte:0',
            'unit' => 'required|string|max:10',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataCreate = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'unit' => $request->unit,
        ];
        $ingredient = \App\Models\Ingredient::create($dataCreate);
        return back()->with('success', 'Berhasil menambahkan data komposisi');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ingredient = \App\Models\Ingredient::findOrFail($id);
        return view('ingredient.edit',compact('ingredient'));
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
        $ingredient = \App\Models\Ingredient::findOrFail($id);
        $input = $request->all();

        $dataValidator = [
            'product_id' => 'required|numeric',
            'name' => 'required|string',
            'amount' => 'required|numeric|gte:0',
            'unit' => 'required|string|max:10',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataUpdate = [
            'product_id' => $request->product_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'unit' => $request->unit,
        ];
        $ingredient->update($dataUpdate);
        return back()->with('success', 'Berhasil memperbarui data komposisi');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $ingredient = \App\Models\Ingredient::findOrFail($id);
        if($ingredient->get()->isEmpty()){
            return back()->with('error', ['Data tidak ditemukan!']);
        }
        $ingredient->delete();
        return back()->with('success', 'Berhasil menghapus data komposisi');
    }
}
