<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Team;
use App\Models\Competition;


use Spatie\Permission\Models\Role;
use App\Models\Season;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use spatie\Html\Elements\Form;


class FixtureController extends Controller
{

    public function index()
    {
        $fixtures = Fixture::orderBy('date', 'asc')->get();

        return view('fixtures.index', compact('fixtures'));
    }

    public function show($season_id)
    {
        $fixtures = Fixture::where('season_id', $season_id)
            ->orderBy('date', 'asc')
            ->get();

        $selectedSeason = Season::find($season_id);

        return view('fixtures.showBySeason', compact('fixtures', 'selectedSeason'));
    }

    public function create()
    {
        $highestSeasonId = Season::max('id');
        $teams = Team::pluck('team_name', 'id');
        $competitions = Competition::pluck('competitions_name', 'id');

        return view('fixtures.create', compact('teams','competitions', 'highestSeasonId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'competition_id' => 'required',
            'home_team_id' => 'required|different:away_team_id',
            'away_team_id' => 'required',
            'date' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {
            Fixture::create([
                'season_id' => $request->highestSeasonId,
                'competition_id' => $request->competition_id,
                'home_team_id' => $request->home_team_id,
                'away_team_id' => $request->away_team_id,
                'home_score' => $request->home_score,
                'away_score' => $request->away_score,
                'date' => $request->date,
            ]);
        });

        return redirect()->route('fixtures.index');
    }

    public function edit(Fixture $fixture)
    {
        $teams = Team::pluck('team_name', 'id');

        return view('fixtures.edit', compact('fixture', 'teams'));
    }

    public function update(Request $request, Fixture $fixture)
    {
        $request->validate([
            'home_team_id' => 'required|different:away_team_id',
            'away_team_id' => 'required',
            'date' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $fixture) {
            $fixture->update([
                'season_id' => $request->highestSeasonId,
                'competition_id' => $request->competition_id,
                'home_team_id' => $request->home_team_id,
                'away_team_id' => $request->away_team_id,
                'home_score' => $request->home_score,
                'away_score' => $request->away_score,
                'date' => $request->date,
            ]);
        });

        return redirect()->route('fixtures.index');
    }

    public function destroy(Fixture $fixture)
    {
        $fixture->delete();

        return redirect()->route('fixtures.index');
    }
}
