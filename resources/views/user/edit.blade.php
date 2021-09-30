@extends('layouts.app')

@section('title', 'Edit Karyawan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Karyawan</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('user.index') }}">
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
                <form action="{{ route('user.update') }}">
                    @csrf
                    @method('patch')
                    <div class="form-group">
                        <label>Outlet Karyawan (Pilih satu):</label>
                        <select class="form-control" id="sel1" name="outlet_id">
                            @forelse($outlet as $data)
                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Karyawan</label>
                        <input type="text" class="form-control input-default " name="name" value="{{ $user->name }}"
                            placeholder="Tulis nama karyawan..." required>
                    </div>
                    <div class="form-group">
                        <label>Email Karyawan</label>
                        <input type="email" class="form-control input-default " name="email" value="{{ $user->email }}"
                            placeholder="Tulis email karyawan... (e.g. asd@mail.com)" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telpon Karwayan</label>
                        <input type="text" class="form-control input-default " name="phone" value="{{ $user->phone }}"
                            placeholder="Tulis no. telpon karyawan... (e.g. 088812459583)" required>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection