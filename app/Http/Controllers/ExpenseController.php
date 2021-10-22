<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $outlet = \App\Models\Outlet::where('id', '!=', 1)->get();
        return view('expense.index',compact('outlet'));
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
        $expense = \App\Models\Expense::where("outlet_id", $outlet->id)->get();
        return view('expense.list',compact('outlet','expense'));
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
        return view('expense.create',compact('outlet'));
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
        $input = $request->all();

        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'unit' => 'required|string|max:10',
            'price' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataCreate = [
            'outlet_id' => $request->outlet_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'unit' => $request->unit,
            'price' => $request->price,
        ];
        $expense = \App\Models\Expense::create($dataCreate);

        // history
        $outlet = \App\Models\Outlet::findOrFail($request->outlet_id);
        $dataHistory = [
            'user_id' => $user->id,
            'category' => 'Pengeluaran',
            'description' => 'Menambah data pengeluaran outlet '. $outlet->name .
                             '<br> - barang: '. $request->name,
                             '<br> - jumlah: '. $request->amount .' '. $request->unit .
                             '<br> - harga: '. $request->price,
        ];
        $history = \App\Models\History::create($dataHistory);

        return back()->with('success', 'Berhasil menambahkan data pengeluaran');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expense = \App\Models\Expense::findOrFail($id);
        return view('expense.show',compact('expense'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expense = \App\Models\Expense::findOrFail($id);
        return view('expense.edit',compact('expense'));
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
        $expense = \App\Models\Expense::findOrFail($id);
        $input = $request->all();

        $dataValidator = [
            'outlet_id' => 'required|numeric',
            'name' => 'required|string',
            'amount' => 'required|numeric',
            'unit' => 'required|string|max:10',
            'price' => 'required|numeric',
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        $dataUpdate = [
            'outlet_id' => $request->outlet_id,
            'name' => $request->name,
            'amount' => $request->amount,
            'unit' => $request->unit,
            'price' => $request->price,
        ];
        $expense->update($dataUpdate);
        return back()->with('success', 'Berhasil memperbarui data pengeluaran');
    }
}
