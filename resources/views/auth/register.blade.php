@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card m-auto w-50">
            <div class="card-header card-header-pills">
                <h4 class="card-title">Register</h4>
            </div>
            <form action="{{ route('newUser') }}" method="post">
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
