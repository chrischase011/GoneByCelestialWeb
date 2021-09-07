@extends('layouts.app')
@section('content')
@foreach($data as $news)
@endforeach
    <div class="container p-3 rounded" style="background: #1d2124;">
        <div class="card w-75 m-auto">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title h3">{{ $news->title }}</h4>
                    </div>
                    <div class="col-4">
                        <a href="{{ url()->previous()  }}" class="btn btn-outline-dark float-right">Back</a>
                    </div>
                </div>

            </div>
            <div class="card-body">
                {!! $news->editor !!}
            </div>
            <div class="card-footer">
                <h6>Posted by:
                    @foreach($admins as $admin)
                        @if($news->user_id == $admin->user_id)
                            <b>{{$admin->fname.' '.$admin->lname}}</b>
                        @endif
                    @endforeach
                </h6>
                <h6>Posted at: {{date('F d, Y | h:i A',strtotime($news->created_at))}}</h6>
            </div>
        </div>
    </div>


@endsection
