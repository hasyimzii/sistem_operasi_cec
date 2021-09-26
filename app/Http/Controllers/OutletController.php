<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::all();
        return view('outlet.index',compact('outlet'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlet.create');
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
            'name' => 'required|string',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return response()->json(['status' => false ,'message' => $validator->errors()->all()], 400);
        }

        $dataCreate = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $outlet = \App\Models\Outlet::create($dataCreate);
        return response()->json(['status' => true ,'message' => 'Berhasil menambahkan data outlet']);
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
        return view('outlet.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $outlet = \App\Models\Outlet::findOrFail($id);
        return view('outlet.edit',compact('outlet'));
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
        $outlet = \App\Models\Outlet::findOrFail($id);
        $input = $request->all();

        $dataValidator = [
            'name' => 'required|string',
            'phone' => 'required|string|max:15',
            'address' => 'required|string',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return response()->json(['status' => false ,'message' => $validator->errors()->all()], 400);
        }

        $dataUpdate = [
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
        $outlet->update($dataUpdate);
        return response()->json(['status' => true ,'message' => 'Berhasil memperbarui data outlet']);
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
