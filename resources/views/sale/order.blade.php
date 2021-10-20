@extends('layouts.app')

@section('title', 'Data Order Penjualan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Order Penjualan</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('sale.list', $sale->outlet_id) }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display text-muted" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($order as $data)
                                <tr>
                                    <td>{{ $data->stock->product->name }}</td>
                                    <td>{{ $data->amount }}</td>
                                    <td>{{ $data->price }}</td>
                                    <td>Rp {{ ( $data->amount * $data->price) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('sale.showOrder', $data->id) }}">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            @if(auth()->user()->role->name == 'admin')
                                            <a href="{{ route('sale.edit', $data->id) }}">
                                                <button type="button" class="btn btn-warning">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
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