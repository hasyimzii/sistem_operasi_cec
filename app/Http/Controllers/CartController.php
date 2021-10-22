<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Add sale list items.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
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
    public function delete($id)
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
    public function clear($id)
    {
        $user = auth()->user();
        $cartId = \App\Models\Cart::where('user_id', $user->id)->get(['id']);
        \App\Models\Cart::destroy($cartId->toArray());
        return back();
    }
}
