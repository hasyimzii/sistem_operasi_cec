@extends('layouts.app')

@section('title', 'Tambah Kategori')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Tambah Kategori</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('category.index') }}">
            <button type="button" class="btn btn-light">
                Kembali
            </button>
        </a>
    </div>
</div>
<!-- row -->

<div class="col-xl-6 col-xxl-12">
    <div class="card">
        @if ($message = Session::get('success'))
        <div class="mt-4 mb-0 mx-4 alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            {{ $message }}
        </div>
        @elseif ($message = Session::get('error'))
        <div class="mt-4 mb-0 mx-4 alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>    
            {{ $message }}
        </div>
        @endif
        <div class="card-body">
            <div class="basic-form">
                <form action="{{ route('category.create') }}" method="post">
                    @csrf
                    <div class="form-row">
                        <div class="col-sm-5">
                            <label>Nama Kategori</label>
                            <input type="text" class="form-control" name="name" placeholder="Tulis nama kategori" required>
                        </div>
                    </div><br>
                    <button type="submit" class="btn btn-primary col-sm-5">Tambah Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection