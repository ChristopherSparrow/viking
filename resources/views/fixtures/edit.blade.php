@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Fixture') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('fixtures.update', $fixture) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <label for="home_team_id" class="col-md-4 col-form-label text-md-right">{{ __('Home Team') }}</label>

                                <div class="col-md-6">
                                    {!! Form::select('home_team_id', $teams, $fixture->home_team_id, ['class' => 'form-control']) !!}

                                    @error('home_team_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="away_team_id" class="col-md-4 col-form-label text-md-right">{{ __('Away Team') }}</label>

                                <div class="col-md-6">
                                    {!! Form::select('away_team_id', $teams, $fixture->away_team_id, ['class' => 'form-control']) !!}

                                    @error('away_team_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ $fixture->date }}" required autocomplete="date" autofocus>

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="home_score" class="col-md-4 col-form-label text-md-right">{{ __('Home Score') }}</label>

                                <div class="col-md-6">
                                    <input id="home_score" type="number" class="form-control @error('home_score') is-invalid @enderror" name="home_score" value="{{ $fixture->home_score }}" required autocomplete="home_score" autofocus>

                                    @error('home_score')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="away_score" class="col-md-4 col-form-label text-md-right">{{ __('Away Score') }}</label>

                                <div class="col-md-6">
                                    <input id="away_score" type="number" class="form-control @error('away_score') is-invalid @enderror" name="away_score" value="{{ $fixture->away_score }}" required autocomplete="away_score" autofocus>

                                    @error('away_score')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Update Fixture') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
