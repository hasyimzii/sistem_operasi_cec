@extends('layouts.app')

@section('title', 'Data Pengeluaran')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Pengeluaran</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('expense.create', $outlet->id) }}">
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
                                <th>Tanggal</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($expense as $data)
                                <tr>
                                    <td>{{ $data->created_at }}</td>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->amount }} {{ $data->unit }}</td>
                                    <td>Rp {{ $data->price }}</td>
                                    <td>{{ ($data->amount * $data->price) }}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('expense.show', $data->id) }}">
                                                <button type="button" class="btn btn-info">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </a>
                                            <a href="{{ route('expense.edit', $data->id) }}">
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