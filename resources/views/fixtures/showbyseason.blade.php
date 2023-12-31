@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Fixtures</h1>
        <div class="row justify-content-center">
            @foreach ($fixtures->groupBy('date') as $date => $fixturesByDate)
   
            <div class="col-lg-4">
                <div class="card">

                    
                    <div class="card-header">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</div>

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






                        
                        
                    </div>
                </div>
            </div>
            @endforeach
            <a href="{{ route('fixtures.create') }}" class="btn btn-success">{{ __('Create Fixture') }}</a>
        </div>
    </div>
@endsection
