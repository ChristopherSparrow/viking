<?php

namespace App\Http\Controllers;
use App\Models\Fixture;
use App\Models\Team;
use App\Models\Season;
use App\Models\Competition;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomepageController extends Controller
{
    public function index()
    {
        $highestSeason = Competition::where('comp_type', 1)->max('season_id');

        $nextLFixture = Fixture::where('date', '>', Carbon::now())
            ->whereHas('competition', function ($query) use ($highestSeason) {
                $query->where('season_id', $highestSeason)->where('comp_type', 1);
            })
            ->orderBy('date', 'asc')
            ->first();
            if ($nextLFixture) {
                $Leaguefixtures = Fixture::where('date', $nextLFixture->date)
                    ->whereHas('competition', function ($query) use ($highestSeason) {
                        $query->where('season_id', $highestSeason)->where('comp_type', 1);
                    })
                    ->orderBy('date', 'asc')
                    ->get();
        } else {
            $Leaguefixtures = [];
        }

        $nextCFixture = Fixture::where('date', '>', Carbon::now())
        ->whereHas('competition', function ($query) use ($highestSeason) {
            $query->where('season_id', $highestSeason)->where('comp_type', 2);
        })
        ->orderBy('date', 'asc')
        ->first();
        if ($nextCFixture) {
            $Cupfixtures = Fixture::where('date', $nextCFixture->date)
                ->whereHas('competition', function ($query) use ($highestSeason) {
                    $query->where('season_id', $highestSeason)->where('comp_type', 2);
                })
                ->with('competition') // Eager load the competition relationship
                ->orderBy('date', 'asc')
                ->get();
                $message = "";
            } else {
                $Cupfixtures = [];
                $message = "No fixtures";
            }

        $lastResult = Fixture::where('date', '<', Carbon::now())
        ->whereHas('competition', function ($query) use ($highestSeason) {
            $query->where('season_id', $highestSeason)->where('comp_type', 1);
        })
        ->orderBy('date', 'desc')->first();

        // Check if there are any last results
        if ($lastResult) {
            // If there are last results, retrieve all fixtures with the same date
            $lastResults = Fixture::where('date', $lastResult->date)
            ->whereHas('competition', function ($query) use ($highestSeason) {
                $query->where('season_id', $highestSeason)->where('comp_type', 1);
            })
            ->orderBy('date', 'asc')->get();
        } else {
            // If there are no last results, set $lastResults to an empty array
            $lastResults = [];
        }

        $standings = DB::table(DB::raw('(SELECT id, home_team_id AS badger, 
        CASE WHEN home_score IS NOT NULL THEN 1 ELSE 0 END AS pl,
        CASE WHEN home_score > away_score THEN 1 ELSE 0 END AS win,
        CASE WHEN home_score < away_score THEN 1 ELSE 0 END AS loss,
        CASE WHEN home_score = away_score THEN 1 ELSE 0 END AS tie,
        home_score AS pts
        FROM fixtures 
        WHERE away_team_id != \'bye\' AND competition_id IN (
            SELECT id FROM competitions WHERE comp_type = 1
        )
        UNION
        SELECT id, away_team_id AS badger,
            CASE WHEN away_score IS NOT NULL THEN 1 ELSE 0 END AS pl,
            CASE WHEN away_score > home_score THEN 1 ELSE 0 END AS win,
            CASE WHEN away_score < home_score THEN 1 ELSE 0 END AS loss,
            CASE WHEN away_score = home_score THEN 1 ELSE 0 END AS tie,
            away_score AS pts
            FROM fixtures 
            WHERE home_team_id != \'bye\' AND competition_id IN (
                SELECT id FROM competitions WHERE comp_type = 1
            )
        ) as m'))
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

        $news = News::latest()->get();

        return view('homepage.index', compact('Leaguefixtures', 'standings', 'lastResults', 'news', 'Cupfixtures','message'));
}
    }

