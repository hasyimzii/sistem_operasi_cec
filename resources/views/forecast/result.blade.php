@extends('layouts.app')

@section('title', 'Hasil Peramalan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Hasil Peramalan</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('forecast.list', $outlet->id) }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<!-- forecast -->


<!-- ingredient -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Peramalan Kebutuhan Komposisi Produk {{ $stock->product->name }} Bulan Depan</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display text-muted" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Nama Komposisi</th>
                                <th>Jumlah Kebutuhan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ingredient as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ ($data->amount * ...) }} {{ $data->unit }}</td>
                                </tr>
                            @empty
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection