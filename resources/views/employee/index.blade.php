@extends('layouts.app')

@section('title', 'Data Karyawan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Karyawan</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('employee.create') }}">
            <button type="button" class="btn btn-primary">
                Tambah Data
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
                                <th>Nama Lengkap</th>
                                <th>Outlet Asal</th>
                                <th>Email</th>
                                <th>No. Telpon</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($user as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->outlet->name }}</td>
                                    <td>{{ $data->email }}</td>
                                    <td>{{ $data->phone }}</td>
                                    <td>{{ $data->active == 1 ? "Aktif" : "Tidak Aktif" }}
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('employee.show', $data->id) }}">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('employee.edit', $data->id) }}">
                                                <button type="button" class="btn btn-warning">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                            </a>
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