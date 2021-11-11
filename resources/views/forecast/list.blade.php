@extends('layouts.app')

@section('title', 'Data Stok Peramalan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Stok Peramalan</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('forecast.index') }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->


<div class="col-xl-12 col-xxl-12">
    <div class="card">
        @if($message = Session::get('error'))
            <div class="mt-4 mb-0 mx-4 alert alert-danger alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ $message }}
            </div>
        @endif
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('forecast.result', $outlet->id) }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-5">
                            <label>Stok Produk (Pilih satu):</label>
                            <select class="form-control" id="sel1" name="stock_id">
                                @forelse($stock as $data)
                                <option value="{{ $data->id }}">{{ $data->product->name }}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-primary col-sm-5">Lihat Peramalan Penjualan</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection