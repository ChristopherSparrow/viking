<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;
    protected $fillable = [
        'team_name',
    ];

    public function competition()
{
    return $this->belongsTo(Competition::class);
}

    public function fixtures()
    {
        return $this->hasMany(Fixture::class);
    }

    public function standings()
    {
        return $this->hasMany(Fixture::class);
    }
    }