@extends('layouts.app')

@section('title', 'Edit Stok')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Stok</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('stock.list', $stock->outlet->id) }}">
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
                <form action="{{ route('stock.update', $stock->id) }}" method="post">
                    @csrf
                    <input type="number" name="product_id" value="{{ $stock->product->id }}" hidden>
                    <div class="form-group">
                        <label>Nama Produk</label>
                        <input type="text" class="form-control"  style="background: #c4c4c4;" value="{{ $stock->product->name }}"
                            placeholder="Tulis nama kategori..." disabled>
                    </div>
                    <div class="form-group">
                        <label>Harga Produk (Rp)</label>
                        <input type="number" class="form-control" style="background: #c4c4c4;" value="{{ $stock->price }}" disabled>
                    </div>
                    <div class="form-group">
                        <label>Stok Produk</label>
                        <input type="number" class="form-control" name="amount" value="{{ $stock->amount }}"
                            placeholder="Tulis stok produk..." required>
                    </div>
                    <div class="form-group">
                        <label>Status Produk (Pilih satu):</label>
                        <select class="form-control" id="sel1" name="active">
                            <option value="1"
                                {{ ($stock->active == 1) ? 'selected' :'' }}>
                                Aktif</option>
                            <option value="0"
                                {{ ($stock->active == 0) ? 'selected' :'' }}>
                                Tidak Aktif</option>
                        </select>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection