@extends('layouts.app')

@section('content')

<div class="row homepage-spacer">
    <p><a href="{{ route('homepage.index') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a></p>
    <h1>All Seasons</h1>
    @foreach ($seasons as $season)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">{{ $season->season_name }}</div>
            <div class="card-body"><a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a>
                <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($season->start_date)->format('F j, Y') }}<br><strong>End:</strong>{{ \Carbon\Carbon::parse($season->end_date)->format('F j, Y') }}<br><br></p>
                @foreach ($season->competitions as $competition)
                    <p><strong>{{ $competition->competitions_name }}</strong><br>Winnter - {{ $competition->winner }}<br>Runner Up - {{ $competition->runnerup }}<br></p>
                 @endforeach
            </div>
        </div>
    </div>
    @endforeach
</div>  

@endsection
