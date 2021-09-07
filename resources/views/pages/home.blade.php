@extends('layouts.app')

@section('content')
{{-- Banner  --}}
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-8 col-lg-12">
            <div id="banner" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="false">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="https://wallpaperaccess.com/full/2141401.jpg" class="d-block w-100" alt="..." style="height: 300px; max-height: 300px;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://cdn.wallpapersafari.com/14/52/2rXqit.jpg" class="d-block w-100" alt="..." style="height: 300px; max-height: 300px;">
                    </div>
                    <div class="carousel-item">
                        <img src="https://coolwallpapers.me/picsup/6000656-maniac-killer-sweater-knife-freddy-krueger-glove-nightmares-on-elm-street-smile-horror-stripes.jpg"
                         class="d-block w-100" alt="..." style="height: 300px; max-height: 300px;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{--   End of Banner   --}}
{{-- News Section --}}
    <div class="container my-3 p-2 border-dark rounded" style="background: #1d2124;">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <h2 class="text-center font-weight-bold text-white">Latest News</h2>
            </div>
        </div>
        {{-- News Articles --}}
        <div class="row ">
            @foreach($news as $new)
                <div class="col-4">
                    <div class="card bg-dark" style="height:350px; max-height: 350px;">
                        <div class="card-body">
                            @if($new->preview == "")
                                <img src="https://www.kindpng.com/picc/m/80-807524_no-profile-hd-png-download.png" class="card-img-top" style="height: 250px;">
                            @else
                                <img src="data:image/png;base64, {{$new->preview}}" class="card-img-top">
                            @endif
                        </div>
                        <div class="card-footer">
                            <center>
                                <a href="{{route('preview_news', ['n_id' => $new->n_id])}}" class="text-info text-decoration-none"><strong class="h1">{{$new->title}}</strong></a>
                            </center>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{-- End of News Articles   --}}
    </div>
{{-- End of News Section  --}}
{{-- Updates Section--}}
<div class="container my-3 p-2 border-dark rounded" style="background: #1d2124;">
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <h2 class="text-center font-weight-bold text-white">Latest Updates</h2>
        </div>
    </div>
    {{-- Updates Articles --}}
    <div class="row ">
        @foreach($updates as $update)
            <div class="col-4">
                <div class="card bg-dark" style="height:350px; max-height: 350px;">
                    <div class="card-body">
                        @if($update->preview == "")
                            <img src="https://www.kindpng.com/picc/m/80-807524_no-profile-hd-png-download.png" class="card-img-top" style="height: 250px;">
                        @else
                            <img src="data:image/png;base64, {{$update->preview}}" class="card-img-top">
                        @endif
                    </div>
                    <div class="card-footer">
                        <center>
                            <a href="{{route('preview_updates', ['n_id' => $update->n_id])}}" class="text-info text-decoration-none"><strong class="h1">{{$update->title}}</strong></a>
                        </center>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- End of Updates Articles   --}}
</div>
@endsection
