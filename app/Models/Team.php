<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function groups(){
        return $this->belongsToMany(Group::class, 'team_id');
    }

    public function competitionTeams()
    {
        return $this->hasMany(CompetitionTeam::class);
    }

    public function matches()
    {
        return $this->hasMany(Matche::class);
    }


}
