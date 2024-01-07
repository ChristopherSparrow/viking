@extends('layouts.app')

@section('content')



<div class="row homepage-spacer">
    <p><a href="{{ route('homepage.index') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="{{ route('seasons.index') }}">{{$seasonWithTeams->season_name }}</a> </p>
    <h1>{{ $seasonWithTeams->season_name }}</h1>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">Teams</div>
            <div class="card-body">
                @foreach ($seasonWithTeams->teams as $team)
            <p>{{ $team->team_name }}</p>
        @endforeach</div>
        </div>
    </div>
</div>

@endsection
