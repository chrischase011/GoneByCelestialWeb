@extends('layouts.app')
@section('content')
@foreach($data as $news)
@endforeach
    <div class="container p-3 rounded" style="background: #1d2124;">
        @include('includes.admin')
        <div class="card w-75 m-auto my-3">
            <div class="card-header ">
                <div class="row">
                    <div class="col-8">
                        <h4 class="h3 card-title">Edit <strong>{{$news->title}}</strong></h4>
                    </div>
                    <div class="col-4">
                        <a href="{{ url()->previous() }}" class="btn btn-outline-dark float-right">Back</a>
                    </div>
                </div>
            </div>
            <form action="{{route('edit_news')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="n_id" value="{{$news->n_id}}">
                <div class="card-body">
                    <div class="form-row">
                        <label>Title</label>
                        <input type="text" class="form-control @error('title') @enderror" name="title" value="{{ old('title',$news->title)}}">
                        @error('title')
                        <div class="invalid-feedback">
                            <strong>{{$message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row py-1">
                        <label>Category</label>
                        <select class="form-control" name="category">
                            @if($news->category == '1')
                                <option value="1">News</option>
                                <option value="2">Update</option>
                            @else
                                <option value="2">Update</option>
                                <option value="1">News</option>
                            @endif

                        </select>
                    </div>
                    <div class="form-row my-2">
                        <textarea name="editor" class="@error('editor') is-invalid @enderror" id="editor" style="resize: none;">{!! old('editor',$news->editor) !!}</textarea>
                        @error('title')
                        <div class="invalid-feedback">
                            <strong>{{$message }}</strong>
                        </div>
                        @enderror
                    </div>
                    <div class="form-row my-2">
                        <label>Preview Photo</label>
                        <input type="file" class="form-control form-control-file @error('preview') is-invalid @enderror" name="preview">
                        @error('preview')
                        <div class="invalid-feedback">
                            <strong>{{$message }}</strong>
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-outline-dark btn-block btn-lg">Submit</button>
                </div>
            </form>
        </div>
    </div>


    @include('includes.ckeditor');
@endsection
