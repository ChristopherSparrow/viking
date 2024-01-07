<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use spatie\Html\Elements\Form;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class Team extends Model
{
    use HasApiTokens, HasFactory, HasRoles;
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
