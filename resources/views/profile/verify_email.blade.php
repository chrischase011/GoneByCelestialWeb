@extends('layouts.app')
@section('content')
    <div class="container my-5">
        <h1 class="text-center text-white">Your e-mail has been approved. You can now continue what you're doing.</h1>
    </div>
    <script>
        $(()=>{
            $("#sendContainer").hide();
        });
    </script>
@endsection
