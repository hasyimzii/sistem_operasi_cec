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
                <form action="{{ route('sale.store', $outlet->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $outlet->id }}" hidden>
                    <div class="form-group">
                        <label>Nama Produk (Pilih satu):</label>
                        <select class="form-control" id="sel1" name="stock_id">
                            @forelse($stock as $data)
                            <option value="{{ $data->id }}">{{ $data->product->name }} (Rp {{ $data->price }})</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Produk</label>
                        <input type="number" class="form-control input-default " name="amount"
                            placeholder="Tulis jumlah produk..." required>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection