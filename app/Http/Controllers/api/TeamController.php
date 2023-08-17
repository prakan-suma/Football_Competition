<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function profile($code)
    {
        $team = Team::where('code', $code)->first();
        return response()->json([
            $team,
        ]);
    }
    public function matches($code)
    {
        $team = Team::where('code', $code)->first();

        // dd($team->matches->count());
        foreach ($team->matches as $t) {
            $matches[] = [
                'matches' => [
                    'competition' => [
                        'name' => $t->competition->name,
                        'slug' => $t->competition->slug,
                    ],
                    'stage' => $t->stage,
                    'against_team' => [
                        'id' => $t->against->id,
                        'name' => $t->against->name,
                        'code' => $t->against->code,
                        'logo' => $t->against->logo,
                    ],
                    'score_for' => $t->score_for,
                    'score_against' => $t->score_against
                ]
            ];

        }
        return response()->json([
            $matches
        ]);
    }


}
