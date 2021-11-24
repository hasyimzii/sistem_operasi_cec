@extends('layouts.app')

@section('title', 'Edit Akun')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Edit Akun</h4>
        </div>
    </div>
    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
        <a href="{{ route('user.show', $user->id) }}">
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
                <form action="{{ route('user.update', $user->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control input-default " name="name" value="{{ $user->name }}"
                            placeholder="Tulis nama lengkap kamu..." required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control input-default " name="email"
                            value="{{ $user->email }}" placeholder="Tulis email kamu... (e.g. asd@mail.com)"
                            required>
                    </div>
                    <div class="form-group">
                        <label>No. Telpon</label>
                        <input type="text" class="form-control input-default " name="phone" value="{{ $user->phone }}"
                            placeholder="Tulis no. telpon kamu... (e.g. 088812459583)" required>
                    </div>
                    <div class="form-group">
                        <label>Validasi Password</label>
                        <input type="password" class="form-control input-default " name="password"
                            placeholder="Masukkan password kamu..." required>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Edit Data</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection