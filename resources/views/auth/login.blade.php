@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card w-50 m-auto">
            <div class="card-header card-header-pills">
                <h4 class="card-title">Login</h4>
            </div>
            @if(session()->has('regSuccess'))
                <center>
                    <span class="alert alert-success">{{ session()->get('regSuccess') }}</span>
                </center>
            @endif
            @if(session()->has('loginError'))
                <center>
                    <span class="alert alert-danger">{{ session()->get('loginError') }}</span>
                </center>
            @endif
            <form action="{{ route('loginUser') }}" method="post">
                @csrf
                <div class="card-body">
                    <div class="form-row">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control w-100 @error('username') is-invalid @enderror" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-row py-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control w-100 @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-primary btn-lg btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>

@endsection
