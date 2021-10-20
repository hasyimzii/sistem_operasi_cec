@extends('layouts.app')

@section('title', 'Data Penjualan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Penjualan</h4>
        </div>
    </div>
    @if(auth()->user()->role->name == 'admin')
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('sale.index') }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
    @endif
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
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Total Penjualan</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sale as $data)
                            <!-- count price -->
                                @php
                                    $order = $data->order;
                                    $totalPrice = 0;
                                    foreach($order as $or) {
                                        $result = $or->amount * $or->price;
                                        $totalPrice += $result;
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $totalPrice }}</td>
                                    <td>
                                        <a href="{{ route('sale.order', $data->id) }}">
                                            <button type="button" class="btn btn-info">
                                                <i class="fa fa-eye"></i>
                                            </button>
                                        </a>
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