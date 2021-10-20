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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function order($id)
    {
        $sale = \App\Models\Sale::findOrFail($id);
        $order = \App\Models\Order::where('sale_id', $id)->get();
        return view('sale.order',compact('sale','order'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        return view('sale.showOrder',compact('order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $user = auth()->user();
        $outlet = \App\Models\Outlet::findOrFail($id);
        $stock = \App\Models\Stock::where('outlet_id', $outlet->id)->where('amount', '!=', 0)->get();
        $cart = \App\Models\Cart::where('user_id', $user->id)->get();

        // count price
        $totalPrice = 0;
        foreach($cart as $data) {
            $result = $data->amount * $data->stock->price;
            $totalPrice += $result;
        }
        return view('sale.create',compact('outlet','stock','cart','totalPrice'));
    }

    /**
     * Add sale list items.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addCart(Request $request, $id)
    {
        $user = auth()->user();
        $stock = \App\Models\Stock::findOrFail($request->stock_id);

        // check if cart is exist
        $cart = \App\Models\Cart::where("user_id", $user->id)->get();
        foreach($cart as $data) {
            if($data->stock_id == $request->stock_id) {
                return back()->with('error', ['Gagal, Produk sudah masuk dalam keranjang!']);
            }
        }
        
        // if stock not enough
        $stock = \App\Models\Stock::findOrFail($request->stock_id);
        if($request->amount > $stock->amount) {
            return back()->with('error', ['Stok produk tidak cukup!']);
        }

        $dataCreate = [
            'user_id' => $user->id,
            'stock_id' => $request->stock_id,
            'amount' => $request->amount,
        ];
        $cart = \App\Models\Cart::create($dataCreate);
        return back();
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCart($id)
    {
        $cart = \App\Models\Cart::findOrFail($id);
        if($cart->get()->isEmpty()){
            return back()->with('error', ['Data tidak ditemukan!']);
        }
        $cart->delete();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function clearCart($id)
    {
        $user = auth()->user();
        $cartId = \App\Models\Cart::where('user_id', $user->id)->get(['id']);
        \App\Models\Cart::destroy($cartId->toArray());
        return back();
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
        ];
        $validator = Validator::make($input,$dataValidator);
        if($validator->fails()){
            return back()->with('error', $validator->errors()->all());
        }

        
        // assign cart to sale
        $cart = \App\Models\Cart::where("user_id", $user->id)->get();
        // check cart is empty
        if($cart->isEmpty()) {
            return back()->with('error', ['Gagal, Keranjang kosong!']);
        }

        // countChange
        $change = $request->money - $request->total_price;
        // check money not enough
        if($change < 0) {
            return back()->with('error', ['Gagal, Uang kurang!']);
        }

        // make sale
        $dataSale = [
            'user_id' => $user->id,
            'outlet_id' => $request->outlet_id,
        ];
        $sale = \App\Models\Sale::create($dataSale);

        // make orders
        foreach($cart as $data) {
            $dataCreate = [
                'sale_id' => $sale->id,
                'stock_id' => $data->stock_id,
                'amount' => $data->amount,
                'price' => $data->stock->price,
            ];
            $order = \App\Models\Order::create($dataCreate);

            // decrease stock
            $stock = \App\Models\Stock::findOrFail($data->stock_id);
            $decreasedStock = $stock->amount - $data->amount;
            $dataAmount = ['amount' => $decreasedStock];
            $stock->update($dataAmount);
        }


        // count price
        $totalPrice = 0;
        foreach($cart as $data) {
            $result = $data->amount * $data->stock->price;
            $totalPrice += $result;
        }

        // employee history
        $dataHistory = [
            'user_id' => $user->id,
            'category' => 'Penjualan',
            'description' => 'Melakukan penjualan produk '.
                            ' sebanyak: '. $cart->count() .
                            ', total harga: '. $totalPrice,
        ];
        $history = \App\Models\History::create($dataHistory);

        return back()->with('success', ['Berhasil menambah data penjualan', $change]);
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
        return view('sale.edit',compact('sale'));
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
}
