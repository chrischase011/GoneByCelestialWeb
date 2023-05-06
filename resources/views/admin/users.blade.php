@extends('layouts.app')
@section('content')

    <div class="container p-3 rounded" style="background: #1d2124;">
        @include('includes.admin')
        <div class="row">
            <div class="col-6">
                <h2 class="h1 text-white">User's Management</h2>
            </div>
            <div class="col-6">
                <div class="btn-group float-right">
                    <a href="{{route('admin.add_user', ['token' => \Illuminate\Support\Str::random(35)])}}" class="btn btn-default border text-white" title="Add new user"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>

        <table class="table table-dark table-bordered table-responsive-lg
            table-striped align text-center w-100 rounded">
            <thead>
            <tr>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Roles</th>
                <th>Account Created</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $users)
                <tr>
                    <td>{{ $users->username }}</td>
                    <td>{{ $users->fname }}</td>
                    <td>{{ $users->lname }}</td>
                    <td>
                        @if($users->roles == '1')
                           {{ __('Admin') }}
                        @else
                           {{ __('Member') }}
                        @endif
                    </td>
                    <td>
                        {{ date('F d, Y | h:i A', strtotime($users->created_at)) }}
                    </td>
                    <td>
                        @if(Auth::user()->user_id == $users->user_id)
                            @if(Auth::user()->roles == 1)
                                <button class="btn btn-outline-primary p-1 disabled" disabled>Remove Admin</button>
                            @endif
                        @elseif($users->roles == '1')
                            <button class="btn btn-outline-primary p-1" onclick="removeAdmin('{{$users->id}}','{{csrf_token()}}')">Remove Admin</button>
                        @else
                            <button class="btn btn-outline-light p-1" onclick="setAdmin('{{$users->id}}','{{csrf_token()}}')">Set as Admin</button>
                        @endif
                        <a href="{{ route('admin.edit',['id' => $users->user_id]) }}" class="btn btn-outline-info p-1" data-id="{{ $users->user_id }}">
                            Edit</a>
                        <button class="btn btn-outline-danger p-1" onclick="deleteUser('{{$users->id}}','{{csrf_token()}}')">Delete</button>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                {{$data->links()}}
            </tfoot>
        </table>
    </div>
@include('includes.modals')
@endsection
