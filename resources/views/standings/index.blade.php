@extends('layouts.app')

@section('content')
<div class="container">
    <h1>League Table</h1>
    <div class="row justify-content-center">
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

@endsection