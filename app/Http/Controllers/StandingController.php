<?php

namespace App\Http\Controllers;

use App\Models\Fixture;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StandingController extends Controller
{
    public function standings()
{
    $standings = DB::table(DB::raw('(SELECT id, home_team_id AS badger, 
        CASE WHEN home_score IS NOT NULL THEN 1 ELSE 0 END AS pl,
        CASE WHEN home_score > away_score THEN 1 ELSE 0 END AS win,
        CASE WHEN home_score < away_score THEN 1 ELSE 0 END AS loss,
        CASE WHEN home_score = away_score THEN 1 ELSE 0 END AS tie,
        home_score AS pts
        FROM fixtures WHERE away_team_id != \'bye\'
        UNION
        SELECT id, away_team_id AS badger,
            CASE WHEN away_score IS NOT NULL THEN 1 ELSE 0 END AS pl,
            CASE WHEN away_score > home_score THEN 1 ELSE 0 END AS win,
            CASE WHEN away_score < home_score THEN 1 ELSE 0 END AS loss,
            CASE WHEN away_score = home_score THEN 1 ELSE 0 END AS tie,
            away_score AS pts
            FROM fixtures WHERE home_team_id != \'bye\') as m'))
            ->join('teams', 'teams.id', '=', 'm.badger') // Join with teams table
            ->select('m.badger', 'teams.team_name', 
            DB::raw('SUM(m.pl) as totalpl'),
            DB::raw('SUM(m.win) as totalwin'),
            DB::raw('SUM(m.loss) as totalloss'),
            DB::raw('SUM(m.tie) as totaltie'),
            DB::raw('SUM(m.pts) as totalpts'))
        ->groupBy('m.badger', 'teams.team_name')
        ->orderByDesc('totalpts')
        ->orderByDesc('totalwin')
        ->get();

    return view('standings.index', compact('standings'));
    }




}