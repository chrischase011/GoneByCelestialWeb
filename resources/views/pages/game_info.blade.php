@extends('layouts.app')
@section('content')
    <div class="container">
        <h1 class="text-center h1 text-white">Game Info</h1>

        <div class="container-fluid my-5">
            <video style="width:100%; height:450px;" autoplay controls loop muted id="video">
                <source src="{{URL::asset('/video/BackStory.mp4')}}" type="video/mp4">
            </video>
        </div>
    </div>

    <script>
        document.getElementById("video").play();
    </script>
@endsection