@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card m-auto w-50">
            <div class="card-header card-header-pills">
                <h4 class="card-title">Add new user</h4>
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
                        <label>Web Password</label>
                        <input type="password" name="password" class="form-control w-100 @error('password') is-invalid @enderror" value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>Confirm Web Password</label>
                        <input type="password" name="password_confirmation" class="form-control w-100 @error('password_confirmation') is-invalid @enderror" value="{{ old('password_confirmation') }}">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
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
