@extends('layouts.app')

@section('content')

<h1>Welcome,  {{ __('you are logged in!') }} {{ Auth::user()->name }} </h1>
<div class="container">
    <div class="row justify-content-center homepage-spacer">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Admin Tasks</div>
                <div class="card-body">
                    @can('role-create')
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Manage Roles</a></p><br>
                            <p><a class="btn btn-danger" href="{{ route('users.index') }}">Manage Users</a></p><br>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                            <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Delete Content</a></p>
                    @endcan
                    <p>No admin permissions</p>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Latest News</div>
                <div class="card-body">
                    <p>News placeholder text</p>
                </div>
            </div>
        </div>
    
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">Latest News</div>
                <div class="card-body">
                    <p>News placeholder text</p>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
