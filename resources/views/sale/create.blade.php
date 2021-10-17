@extends('layouts.app')

@section('title', 'Tambah Penjualan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Transaksi Penjualan</h4>
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
                <form action="{{ route('sale.addList', $outlet->id) }}" method="post">
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
                                placeholder="Tulis jumlah produk..." required>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>

    <!-- list orders -->
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
        <div class="card-header">
            <h4 class="card-title">List Order Transaksi</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-responsive-sm">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1</th>
                            <td>Esteh</td>
                            <td>10</td>
                            <td>Rp 10000 22</td>
                            <td>Hapoes</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="basic-form">
                <form action="" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $outlet->id }}" hidden>
                    <button type="submit" class="btn btn-block btn-primary">Simpan Transaksi</button>
                </form>
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
                <form action="" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Total Harga</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="Rp 10000">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pembayaran</label>
                        <div class="col-sm-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control"  name="old_price"
                                    value="0">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary col-sm-2">Hitung Kembalian</button>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kembalian</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="Rp 10000">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection