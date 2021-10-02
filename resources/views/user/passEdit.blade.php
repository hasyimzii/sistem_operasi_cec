@extends('layouts.app')

@section('title', 'Ganti Password')
@section('content')
<div class="row page-titles mx-0" style="background: #343957;">
    <div class="col-sm-6 mt-1 p-md-0">
        <div class="welcome-text">
            <h4 class="text-white">Ganti Password</h4>
        </div>
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
                <form action="{{ route('user.passUpdate', $user->id) }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label>Password Lama</label>
                        <input type="password" class="form-control input-default " name="old_password"
                            placeholder="Masukkan password lama kamu..." required>
                    </div>
                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" class="form-control input-default " name="password"
                            placeholder="Masukkan password baru..." required>
                    </div>
                    <div class="form-group">
                        <label>Konfirmasi Password Baru</label>
                        <input type="password" class="form-control input-default " name="password_confirmation"
                            placeholder="Masukkan konfirmasi password baru..." required>
                    </div><br>
                    <button type="submit" class="btn btn-block btn-primary">Perbarui Password</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection