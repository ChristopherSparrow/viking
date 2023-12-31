@extends('layouts.app')

@section('content')

<div class="container">
    @auth
    <div class="row homepage-spacer">
        <div class="col-lg-12">
            <div class="card viking_card">
                <div class="card-header viking_header">Welcome, {{ Auth::user()->name }}</div>
                <div class="card-body viking_body">
                    @can('role-create')
                    <p><a class="btn btn-danger" href="{{ route('roles.index') }}">Manage Roles</a> &nbsp; | &nbsp; 
                    <a class="btn btn-danger" href="{{ route('users.index') }}">Manage Users</a>  &nbsp; | &nbsp; 
                    <a class="btn btn-danger" href="{{ route('seasons.edit') }}">Manage Seasons</a> &nbsp; | &nbsp;  
                    <a class="btn btn-danger" href="{{ route('fixtures.edit') }}">Manage League</a>  &nbsp; | &nbsp; 
                    <a class="btn btn-danger" href="{{ route('cups.edit') }}">Manage Cups</a>  &nbsp; | &nbsp;  
                    <a class="btn btn-danger" href="{{ route('roles.index') }}">Update Stats</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>  
    @endauth


    <div class="row homepage-spacer">
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

                @foreach ($lastResults->groupBy('date') as $date => $fixturesByDate)
                <div class="card-header">Last League Results - {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</div>
                <div class="card-body">
                    
                    
                    <table class="table">

                        <tbody>
                            @foreach ($fixturesByDate as $fixture)
                                <tr>
                                    <td @if ($fixture->home_score > $fixture->away_score) style="font-weight: bold;" @endif>
                                        {{ $fixture->hometeam->team_name }}
                                    </td>
                                    <td style="text-align: center;">{{ $fixture->home_score }}</td>
                                    <td style="text-align: center;">{{ $fixture->away_score }}</td>
                                    <td @if ($fixture->away_score > $fixture->home_score) style="font-weight: bold; text-align: right;" @else style="text-align: right;" @endif>
                                        {{ $fixture->awayTeam->team_name }}
                                    </td>
                                    @auth
                                    <td>
                                        <a href="{{ route('fixtures.edit', $fixture) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                        <form method="POST" action="{{ route('fixtures.destroy', $fixture) }}" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                        </form>
                                    </td>
                                    @endauth
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        @endforeach
                    
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                @foreach ($fixtures->groupBy('date') as $date => $fixturesByDate)
                <div class="card-header">Next League Fixtures - {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</div>
                    <div class="card-body">

                        <table class="table">

                            <tbody>
                                @foreach ($fixturesByDate as $fixture)
                                    <tr>
                                        <td @if ($fixture->home_score > $fixture->away_score) style="font-weight: bold;" @endif>
                                            {{ $fixture->hometeam->team_name }}
                                        </td>
                                        <td style="text-align: center;">{{ $fixture->home_score }}</td>
                                        <td style="text-align: center;">{{ $fixture->away_score }}</td>
                                        <td @if ($fixture->away_score > $fixture->home_score) style="font-weight: bold; text-align: right;" @else style="text-align: right;" @endif>
                                            {{ $fixture->awayTeam->team_name }}
                                        </td>
                                        @auth
                                        <td>
                                            <a href="{{ route('fixtures.edit', $fixture) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                            <form method="POST" action="{{ route('fixtures.destroy', $fixture) }}" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                        @endauth
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                            @endforeach


                    </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">League Table</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th style="text-align: center;">Pl</th>
                                    <th style="text-align: center;">W</th>
                                    <th style="text-align: center;">D</th>
                                    <th style="text-align: center;">L</th>
                                    <th style="text-align: right;">Pts</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($standings as $standing)
                                <tr>
                                    <td>{{ $standing->team_name }}</td>
                                    <td style="text-align: center;">{{ $standing->totalpl }}</td>
                                    <td style="text-align: center;">{{ $standing->totalwin }}</td>
                                    <td style="text-align: center;">{{ $standing->totaltie }}</td>
                                    <td style="text-align: center;">{{ $standing->totalloss }}</td>
                                    <td style="text-align: right;">{{ $standing->totalpts }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div> 
</div> 

@endsection