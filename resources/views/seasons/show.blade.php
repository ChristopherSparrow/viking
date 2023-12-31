@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $seasonWithTeams->season_name }}</div>

                    <div class="card-body">
                        <ul>
                            @foreach ($seasonWithTeams->competitions as $competition)
                                <p>{{ $competition->competitions_name }}</p>
                            @endforeach
                            @foreach ($seasonWithTeams->teams as $team)
                            <li>{{ $team->team_name }}</li>
                        @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
