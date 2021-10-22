@extends('layouts.app')

@section('title', 'Detail Pengeluaran')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Detail Pengeluaran</h4>
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
        <div class="card-body">
            <div class="basic-form">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Barang</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $expense->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Jumlah</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $expense->amount }} {{ $expense->unit }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Harga Barang</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="Rp {{ $expense->price }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Total Pengeluaran</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="Rp {{ $expense->price }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext"
                                value="{{ $expense->created_at }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection