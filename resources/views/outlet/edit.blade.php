@extends('layouts.app')

@section('title', 'Edit Outlet')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Outlet</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('outlet.index') }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="col-xl-12 col-xxl-12">
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
            <div class="basic-form">
                <form action="{{ route('outlet.update', $outlet->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nama Outlet</label>
                        <input type="text" class="form-control input-default " name="name" value="{{ $outlet->name }}"
                            placeholder="Tulis nama outlet..." required>
                    </div>
                    <div class="form-group">
                        <label>No. Telpon</label>
                        <input type="text" class="form-control input-default " name="phone" value="{{ $outlet->phone }}"
                            placeholder="Tulis no. telpon outlet... (e.g. 088812459583)" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat Outlet</label>
                        <textarea class="form-control" rows="4" name="address" placeholder="Tulis alamat outlet..." required>{{ $outlet->address }}</textarea>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection