@extends('layouts.app')
@section('content')
    <div class="container p-3 rounded" style="background: #1d2124;">
        @include('includes.admin')
        @if(session()->has('status'))
            <center>
                <span class="alert alert-success">{!! session()->get('status')  !!}</span>
            </center>
        @endif
        <div class="row">
            <div class="col-6">
                <h2 class="h1 text-white">News and Updates Management</h2>
            </div>
            <div class="col-6">
                <div class="btn-group float-right">
                    <a href="{{ route('admin.add.news',['v' => \Illuminate\Support\Str::random(30)]) }}" class="btn btn-default border text-white" title="Add news/updates"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <table class="table table-dark table-responsive-lg table-bordered table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Date Created</th>
                    <th>Created by</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1;?>
                @foreach($data as $news)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$news->n_id}}</td>
                        <td>{{$news->title}}</td>
                        <td><b>
                                @if($news->category == '1')
                                    {{ __('News') }}
                                @else
                                    {{ __('Updates') }}
                                @endif
                            </b></td>
                        <td>{{date('F d, Y | h:i A',strtotime($news->created_at))}}</td>
                        <td>
                            @foreach($admins as $admin)
                                @if($admin->user_id == $news->user_id)
                                    {{$admin->username}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @if($news->category == '1')
                                <a href="{{route('preview_news', ['n_id' => $news->n_id])}}" class="btn btn-outline-light p-1">Preview</a>
                            @else
                                <a href="{{route('preview_updates', ['n_id' => $news->n_id])}}" class="btn btn-outline-light p-1">Preview</a>
                            @endif
                            <a href="{{ route('admin.edit.news',['id' => $news->n_id]) }}" class="btn btn-outline-warning p-1">Edit</a>
                            <button class="btn btn-outline-danger p-1">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
