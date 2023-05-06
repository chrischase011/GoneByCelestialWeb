@extends('layouts.app')
@section('content')
    <div class="container my-3">
        <div class="card w-50 m-auto">
            <div class="card-header card-header-pills">
                <h4 class="card-title">Forgot Password</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h6>Please provide your e-mail address.</h6>
                        @if(session()->has("_message"))
                            {!!session()->get('_message')!!}</small>
                        @endif
                        <form action="{{route('checkEmail')}}" method="post">
                            {{csrf_field()}}
                            <input type="email" name="email" class="form-control" placeholder="E-mail Address" required>
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