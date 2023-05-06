@extends('layouts.app')
@section('content')
    <div class="container text-white">
        <div class="row">
            <label>Username</label>
            <input type="text" id="username" class="form-control">
        </div>
        <div class="row mt-4">
            <label>Password</label>
            <input type="password" id="password" class="form-control">
        </div>
        <div class="row mt-5">
            <button type="button" id="btnSubmit" class="btn btn-primary">Submit</button>
        </div>
    </div>

    <script>
        $(()=> {
            $("#btnSubmit").click(()=>{
                $token = $("#csrf").attr('content');
                $.ajax({
                    url: "{{ route('api.checkUser') }}",
                    type: 'post',
                    data: {'_token':$token, username: $("#username").val(), password: $("#password").val()},
                    dataType: 'json',
                    success: (data) =>
                    {
                        alert(JSON.stringify(data));
                    }
                });
            });
        });
    </script>
@endsection