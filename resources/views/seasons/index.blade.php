@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header">Seasons and Competitions</div>

                    <div class="card-body">
                        @foreach ($seasons as $season)
                            <p><strong><a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a></strong></p>
                            <ul>
                                @foreach ($season->competitions as $competition)
                                    <li>{{ $competition->competitions_name }}</li>
                                @endforeach
                            </ul>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
