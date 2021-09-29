@extends('layouts.app')

@section('title', 'Admin')
@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <h1>HALOOOO</h1>
        <div class="card">
            <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif

                {{ __('You are logged in!') }}
            </div>
        </div>
    </div>
</div>
@endsection