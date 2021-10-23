@extends('layouts.app')

@section('title', 'Rekap Laporan Keuangan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Rekap Laporan Keuangan</h4>
        </div>
    </div>
</div>
<!-- row -->


<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Laporan</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Penjualan</td>
                                <td>{{ $totalSale }}</td>
                            </tr>
                            <tr>
                                <td>Pengeluaran</td>
                                <td>{{ $totalExpense }}</td>
                            </tr>
                            <tr>
                                <td>Pendapatan Bersih</td>
                                <td>
                                    @if($totalAll > 0)
                                        <div class="text-success">{{ $totalAll }}</div>
                                    @elseif($totalAll < 0)
                                        <div class="text-danger">{{ $totalAll }}</div>
                                    @else
                                        <div>{{ $totalAll }}</div>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection