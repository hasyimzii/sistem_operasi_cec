@extends('layouts.app')

@section('title', 'Data Komposisi')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Data Komposisi</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('ingredient.create', $product->id) }}">
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
            @if($message = Session::get('success'))
                <div class="mt-4 mb-0 mx-4 alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    {{ $message }}
                </div>
            @elseif($message = Session::get('error'))
                @foreach($message as $msg)
                    <div class="mt-4 mb-0 mx-4 alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        {{ $msg }}
                    </div>
                @endforeach
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display text-muted" style="min-width: 845px">
                        <thead>
                            <tr>
                                <th>Nama Komposisi</th>
                                <th>Jumlah</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ingredient as $data)
                                <tr>
                                    <td>{{ $data->name }}</td>
                                    <td>{{ $data->amount }} {{ $data->unit }}</td>
                                    <td>
                                        <form action="{{ route('ingredient.delete', $data->id) }}"
                                            method="post">
                                            @csrf
                                            <div class="btn-group">
                                                <a href="{{ route('ingredient.edit', $data->id) }}">
                                                    <button type="button" class="btn btn-warning">
                                                        <i class="fa fa-pencil"></i>
                                                    </button>
                                                </a>
                                                <button type="submit" class="btn btn-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </div>
                                        </form>
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