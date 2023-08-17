<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AllowedCountries extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function countries()
    {
        return $this->belongsTo(Countries::class, 'countries_id');
    }

    public function competitions()
    {
        return $this->belongsTo(Competition::class);
    }
}
