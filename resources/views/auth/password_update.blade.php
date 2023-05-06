@extends('layouts.app')
@section('content')

<div class="container my-3">
    <div class="card w-50 m-auto">
        <div class="card-header card-header-pills">
            <h4 class="card-title">Password Update</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('newPassword')}}" method="post">
                        {{csrf_field()}}
                        
                        <input type="hidden" name="id" value="{{$user->id}}">
                        
                        <div class="row">
                            <div class="col-12">
                                <label>New Password</label>
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-12">
                                <label>Confirm New Password</label>
                                <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="container w-100 mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection