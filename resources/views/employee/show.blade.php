@extends('layouts.app')

@section('title', 'Detail Karyawan')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Detail Karyawan</h4>
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
        <div class="card-body">
            <div class="basic-form">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Lengkap</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Asal Outlet</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user->outlet->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Email</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user->email }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No .Telpon</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Daftar</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $user->created_at }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Status Karyawan</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ ($user->active == 1) ? 'Aktif' : 'Tidak Aktif' }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection