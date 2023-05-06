@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            @foreach($articles as $article)
                <div class="col-4 my-3">
                    <div class="card bg-dark border-white w-100 h-100">
                        <div class="card-header">
                            <a href="{{ $article->category == '1' ? route('preview_news', ['n_id' => $article->n_id]) : route('preview_updates', ['n_id' => $article->n_id])}}"><h2>{{$article->title}}</h2></a>
                        </div>
                        <div class="card-body">
                            <img src="data:image/jpg;base64, {{$article->preview}}" class="card-img-top w-100 h-100">
                        </div>
                        <div class="card-footer d-flex justify-content-center">
                            <small class="text-white text-center pt-3">{{ date('F d, Y h:i a', strtotime($article->created_at)) }}</small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection