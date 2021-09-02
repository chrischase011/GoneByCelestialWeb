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
    <div class="container my-3 p-2 border-dark bg-light rounded">
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <h2 class="text-center font-weight-bold">Latest News</h2>
            </div>
        </div>
        {{-- News Articles --}}
        <div class="row justify-content-center">
            <div class="">

            </div>
        </div>
        {{-- End of News Articles   --}}
    </div>
{{-- End of News Section  --}}
@endsection
