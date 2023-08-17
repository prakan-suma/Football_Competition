<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function allowed(){
        return $this->hasMany(AllowedCountries::class);
    }

    public function countries()
    {
        return $this->hasManyThrough(Countries::class, AllowedCountries::class, 'competition_id', 'id', 'id', 'countries_id');
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function teams()
    {
        return $this->hasMany(CompetitionTeams::class);
    }
    public function matches()
    {
        return $this->hasMany(Matche::class);
    }


}
