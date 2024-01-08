<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Fixture extends Model
{
    use HasApiTokens, HasFactory, HasRoles;

    protected $fillable = [
        'season_id',
        'competition_id',
        'home_team_id',
        'away_team_id',
        'date',
        'home_score',
        'away_score',
    ];

    public function homeTeam()
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function season_id()
    {
        return $this->belongsTo(Season::class, 'id');
    }

    public function competition()
    {
        return $this->belongsTo(Competition::class);
    }
}
