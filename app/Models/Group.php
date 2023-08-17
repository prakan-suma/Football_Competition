<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function teams(){
        return $this->belongsTo(Team::class , 'team_id');
    }

    public function competition(){
        return $this->belongsTo(Competition::class);
    }
}
