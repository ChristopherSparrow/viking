<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Standing extends Model
{
    use HasFactory;

    
    public function badger()
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }
}
