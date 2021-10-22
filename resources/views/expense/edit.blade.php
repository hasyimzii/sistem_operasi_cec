@extends('layouts.app')

@section('title', 'Edit Pengeluaran')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Pengeluaran</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('expense.list', $expense->outlet->id) }}">
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
                <form action="{{ route('expense.update', $expense->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $expense->outlet->id }}" hidden>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control input-default " name="name"
                            placeholder="Tulis nama barang..." value="{{ $expense->name }}" required>
                    </div>
                    <div class="form-group">
                        <label>Jumlah</label>
                        <input type="number" class="form-control input-default " name="amount"
                            placeholder="Tulis jumlah barang..." value="{{ $expense->amount }}" required>
                    </div>
                    <div class="form-group">
                        <label>Satuan (contoh: kg, liter, pack, dll)</label>
                        <input type="text" class="form-control input-default " name="unit"
                            placeholder="Tulis satuan jumlah barang..." value="{{ $expense->unit }}" required>
                    </div>
                    <label>Harga Barang</label>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Rp</span>
                                </div>
                                <input type="number" class="form-control" name="price" value="{{ $expense->price }}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection