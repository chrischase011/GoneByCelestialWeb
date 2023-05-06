@extends('layouts.app')
@section('content')
@foreach($data as $user)
@endforeach
    <div class="container p-3 rounded" style="background: #1d2124;">
        @include('includes.admin')
        <div class="card w-50 m-auto my-3">
            <div class="card-header ">
                <div class="row">
                    <div class="col-8">
                        <h4 class="h3">Edit <span class="font-weight-bold">{{ $user->fname.' '.$user->lname }}</span></h4>
                    </div>
                    <div class="col-4">
                        <a href="{{ url()->previous()  }}" class="btn btn-outline-dark float-right">Back</a>
                    </div>
                </div>
                @if(session()->has('invalidPassword'))
                    <div class="row p-3">
                        <div class="col-12">
                            <center>
                                <span class="alert alert-danger text-center">{!! session()->get('invalidPassword') !!}</span>
                            </center>
                        </div>
                    </div>
                @endif
                @if(session()->has('editSuccess'))
                    <div class="row p-3">
                        <div class="col-12">
                        <center>
                            <span class="alert alert-success text-center">{!! session()->get('editSuccess') !!}</span>
                        </center>
                      </div>
                     </div>
                @endif
            </div>
            <form action="{{ route('admin.edit_user') }}" method="post">
                @csrf
                <div class="card-body">
                    <input type="hidden" id="edit_user_id" name="user_id" value="{{$user->user_id }}">
                    <div class="form-row">
                        <label>Username</label>
                        <input type="text" class="form-control" disabled value="{{ $user->username }}">
                    </div>
                    <div class="form-row">
                        <label>Set New Web Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                               id="editPassword" value="{{ old('password') }}">
                        @error('password')
                            <div class="invalid-feedback">
                                <strong>{{$message }}</strong>
                            </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>Confirm New Web Password</label>
                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            <strong>{{$message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>First name</label>
                        <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{ $user->fname }}">
                        @error('fname')
                        <div class="invalid-feedback">
                            <strong>{{$message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row">
                        <label>Last name</label>
                        <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname"  value="{{ $user->lname }}">
                        @error('lname')
                        <div class="invalid-feedback">
                            <strong>{{$message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-row">
                        <label>Confirm Your Password</label>
                        <input type="password" class="form-control" name="confirm_password">
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-outline-info btn-block" type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>


@endsection
