@extends('layouts.app')

@section('title', 'Data Riwayat')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Riwayat</h4>
        </div>
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
                                <th>Tanggal</th>
                                <th>Nama Karyawan</th>
                                <th>Asal Outlet</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($history as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->user->name }}</td>
                                    <td>{{ $data->user->outlet->name }}</td>
                                    <td>{{ $data->category }}</td>
                                    <td>{!! $data->description !!}</td>
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