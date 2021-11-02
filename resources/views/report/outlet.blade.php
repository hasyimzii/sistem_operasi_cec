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
        <!-- input periode -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Masukkan Periode Laporan</h4>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form action="{{ route('report.outletPeriode', $outlet->id) }}" method="post">
                        @csrf
                        <input type="number" name="outlet_id" value="{{ $outlet->id }}" hidden>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Bulan (Pilih satu):</label>
                                <select class="form-control" id="sel1" name="month">
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Tahun</label>
                                <input type="number" class="form-control input-default " name="year"
                                    placeholder="Tulis tahun laporan..." maxlength="4" value="2000" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-primary">Lihat Laporan</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- list report -->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Laporan Bulan {{ $monthName }} {{ $year }}</th>
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