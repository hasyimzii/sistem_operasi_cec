@extends('layouts.app')

@section('title', 'Tambah Pengeluaran')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Pengeluaran</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('expense.list', $outlet->id) }}">
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
                <form action="{{ route('expense.store', $outlet->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $outlet->id }}" hidden>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control input-default " name="name"
                            placeholder="Tulis nama barang..." required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control input-default " name="amount"
                            placeholder="Tulis jumlah barang..." required>
                    </div>
                    <div class="form-group">
                        <label>Satuan (contoh: kg, liter, pack, dll)</label>
                        <input type="text" class="form-control input-default " name="unit"
                            placeholder="Tulis satuan jumlah barang..." required>
                    </div>
                    <label>Harga Barang</label>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="price" value="0" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection