@extends('layouts.app')
@section('content')

    <div class="container bg-light p-2 rounded">
        @include('includes.admin')
        <div class="row p-4">
            <div class="col-3">
                <div class="card">
                    <div class="card-header text-white" style="background:#957DAD;">
                        <h3 class="card-title h4 text-center">Total Downloads</h3>
                    </div>
                    <div class="card-body p-5">
                        <h2 class="text-center">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header text-white" style="background:#D291BC;">
                        <h3 class="card-title h4 text-center">Users</h3>
                    </div>
                    <div class="card-body p-5">
                        <h2 class="text-center">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header text-black-50" style="background:#C4FAF8;">
                        <h3 class="card-title h4 text-center">News</h3>
                    </div>
                    <div class="card-body p-5">
                        <h2 class="text-center">0</h2>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-header text-white" style="background:#6EB5FF;">
                        <h3 class="card-title h4 text-center">Updates</h3>
                    </div>
                    <div class="card-body p-5">
                        <h2 class="text-center">0</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

