@extends('layouts.app')
@section('content')
    <div class="container p-3 rounded" style="background: #1d2124;">
        @include('includes.admin')
        <div class="card m-auto w-50">
            <div class="card-header rounded-top">
                <div class="row">
                    <div class="col-8">
                        <h4 class="h3 card-title">Add new user</h4>
                    </div>
                    <div class="col-4">
                        <a href="{{ url()->previous()  }}" class="btn btn-outline-dark float-right">Back</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('admin.add.user') }}" method="post">
                @csrf
                @if(session()->has('success'))
                    <center>
                        <span class="alert alert-success">{{session()->get('success')}}</span>
                    </center>
                @endif
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
                    <div class="form-row">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control w-100 @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control w-100 @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row d-none">
                        <label>Game Password </label><span class="text-success ml-auto">Note: This will serve as an in-game password.</span>
                        <input type="password" name="game_password" class="form-control w-100 @error('game_password') is-invalid @enderror" value="{{ old('game_password') }}">
                        @error('game_password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>First name</label>
                        <input type="text" name="fname" class="form-control w-100 @error('fname') is-invalid @enderror" value="{{ old('fname') }}">
                        @error('fname')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>Last name</label>
                        <input type="text" name="lname" class="form-control w-100 @error('lname') is-invalid @enderror" value="{{ old('lname') }}">
                        @error('lname')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-info btn-lg btn-block" type="submit">Register</button>
                </div>
            </form>
        </div>
    </div>

@endsection
