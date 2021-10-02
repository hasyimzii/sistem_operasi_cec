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
        <a href="{{ route('employee.index') }}">
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
                <form action="{{ route('employee.update', $user->id) }}" method="post">
                    @csrf
                    <input type="number" name="outlet_id" value="{{ $user->outlet->id }}" hidden>
                    <div class="form-group">
                        <label>Outlet Karyawan (Pilih satu):</label>
                        <select class="form-control" id="sel1" name="outlet_id">
                            @forelse($outlet as $data)
                                <option value="{{ $data->id }}"
                                    {{ ($data->id == $user->outlet->id) ? 'selected' :'' }}>
                                    {{ $data->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control input-default " name="name" value="{{ $user->name }}"
                            placeholder="Tulis nama lengkap..." required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control input-default " name="email"
                            value="{{ $user->email }}" placeholder="Tulis email... (e.g. asd@mail.com)" required>
                    </div>
                    <div class="form-group">
                        <label>No. Telpon</label>
                        <input type="text" class="form-control input-default " name="phone" value="{{ $user->phone }}"
                            placeholder="Tulis no. telpon... (e.g. 088812459583)" required>
                    </div>
                    <div class="form-group">
                        <label>Status Karyawan (Pilih satu):</label>
                        <select class="form-control" id="sel1" name="active">
                            <option value="1"
                                {{ ($user->active == 1) ? 'selected' :'' }}>
                                Aktif</option>
                            <option value="0"
                                {{ ($user->active == 0) ? 'selected' :'' }}>
                                Tidak Aktif</option>
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection