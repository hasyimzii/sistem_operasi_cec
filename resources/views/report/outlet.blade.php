@extends('layouts.app')

@section('title', 'Laporan Keuangan Outlet')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Laporan Keuangan Outlet</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('report.index') }}">
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
                                <th>Laporan</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Penjualan</td>
                                <td>{{ $totalSale }}</td>
                                <td>
                                    <a href="">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Pengeluaran</td>
                                <td>{{ $totalExpense }}</td>
                                <td>
                                    <a href="">
                                        <button type="button" class="btn btn-info">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Pendapatan Bersih</td>
                                <td>{{ ($totalSale - $totalExpense) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection