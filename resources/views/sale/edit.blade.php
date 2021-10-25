@extends('layouts.app')

@section('title', 'Edit Order')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Order</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('sale.order', $order->sale->id) }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="col-xl-12 col-xxl-12">
    <div class="card">
        @if($message = Session::get('success'))
            <div class="mt-4 mb-0 mx-4 alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $message }}
            </div>
        @elseif($message = Session::get('error'))
            @foreach($message as $msg)
                <div class="mt-4 mb-0 mx-4 alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $msg }}
                </div>
            @endforeach
        @endif
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('sale.update', $order->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $order->sale->outlet->id }}" hidden>
                    <input type="number" name="stock_id" value="{{ $order->stock->id }}" hidden>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control" style="background: #c4c4c4;"
                            value="{{ $order->stock->product->name }}" placeholder="Tulis nama kategori..." disabled>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Jumlah Order Saat Ini</label>
                            <input type="number" class="form-control" style="background: #c4c4c4;" name="old_amount"
                                value="{{ $order->amount }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jumlah Order yang masuk (Beri Minus Jika Ingin Mengurangi, COntoh: -5)</label>
                            <input type="number" class="form-control" name="amount" value="0"
                                placeholder="Tulis stok produk yang masuk..." required>
                        </div>
                    </div>
                    <label>Harga Produk</label>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="price" value="{{ $order->price }}">
                            </div>
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection