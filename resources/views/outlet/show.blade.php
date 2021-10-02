@extends('layouts.app')

@section('title', 'Detail Outlet')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Detail Outlet</h4>
        </div>
    </div>
    @if(auth()->user()->role->name == 'admin')
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('outlet.index') }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
    @endif
</div>
<!-- row -->

<div class="col-xl-12 col-xxl-12">
    <div class="card">
        <div class="card-body">
            <div class="basic-form">
                <form>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Nama Outlet</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $outlet->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">No .Telpon</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $outlet->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Alamat Outlet</label>
                        <div class="col-sm-9">
                            <textarea readonly class="form-control-plaintext" style="resize: none;">{{ $outlet->address }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Tanggal Dibangun</label>
                        <div class="col-sm-9">
                            <input type="text" readonly class="form-control-plaintext" value="{{ $outlet->created_at }}">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection