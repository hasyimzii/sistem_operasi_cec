@extends('layouts.app')

@section('title', 'Tambah Penjualan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Penjualan</h4>
        </div>
    </div>
</div>
<!-- row -->

<div class="col-xl-12 col-xxl-12">
    <!-- input product -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Masukkan Produk</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('sale.addCart', $outlet->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $outlet->id }}" hidden>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nama Produk (Pilih satu):</label>
                            <select class="form-control" id="sel1" name="stock_id">
                                @forelse($stock as $data)
                                    <option value="{{ $data->id }}">{{ $data->product->name }} (Rp
                                        {{ $data->price }})</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jumlah Produk</label>
                            <input type="number" class="form-control input-default " name="amount"
                                placeholder="Tulis jumlah produk..." min="1" value="1" required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>

    <!-- carts -->
    <div class="card">
        @if($message = Session::get('success'))
            <div class="mt-4 mb-0 mx-4 alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $message[0] }}
            </div>
        @elseif($message = Session::get('error'))
            @foreach($message as $msg)
                <div class="mt-4 mb-0 mx-4 alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $msg }}
                </div>
            @endforeach
        @endif
        <div class="card-header">
            <h4 class="card-title">Keranjang Penjualan</h4>
        </div>
        <div class="card-body">
            <div class="basic-form mb-3">
                <form action="{{ route('sale.clearCart', $outlet->id) }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-danger">Hapus Semua</button>
                </form>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cart as $data)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $data->stock->product->name }}</td>
                                <td>{{ $data->amount }}</td>
                                <td>Rp {{ $data->stock->price }}</td>
                                <td>Rp {{ ($data->stock->price * $data->amount) }}</td>
                                <td>
                                    <form action="{{ route('sale.deleteCart', $data->id) }}"
                                        method="post">
                                        @csrf
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- result order -->
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Hasil Transaksi</h4>
        </div>
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('sale.store', $outlet->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $outlet->id }}" hidden>
                    <!-- result order -->
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" style="background: #c4c4c4;"
                                    name="total_price" value="{{ $totalPrice }}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pembayaran</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="money" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kembalian</label>
                        <div class="col-sm-10">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" style="background: #c4c4c4;"
                                    value="{{ $message = Session::get('success')[1] }}" disabled>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Simpan Transaksi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection