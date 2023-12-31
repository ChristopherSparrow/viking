<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    use HasFactory;

    public function competitions()
{
    return $this->hasMany(Competition::class);
}
public function teams()
{
    return $this->hasMany(Team::class);
}

public function fixtures()
{
    return $this->hasMany(Fixture::class);
}
}
    