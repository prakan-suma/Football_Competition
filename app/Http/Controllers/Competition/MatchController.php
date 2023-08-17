<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\Group;
use App\Models\Matche;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    public function matches($slug)
    {
        $competitions = Competition::where('slug', $slug)->first();
        $matches = Matche::where('competition_id', $competitions->id)->orderby('group_at', 'ASC')->get();
        $matchesGroup = $matches->groupBy('group_at');
        return view('competition.matches', compact(['matchesGroup'], ['competitions']));
    }

    public function createMatches($slug)
    {
        $competition = Competition::where('slug', $slug)->first();
        $groups = Group::where('competition_id', $competition->id)->get();
        $groups->sortBy('Pts');
        $group = $groups->groupBy('group_at');

        for ($i = 1; $i <= $group->count(); $i++) {
            $teams = $group[$i];

            for ($j = 0; $j < $teams->count(); $j++) {

                for ($k = $j + 1; $k < $teams->count(); $k++) {

                    $h = $teams[$j]->team_id;
                    $a = $teams[$k]->team_id;

                    Matche::create([
                        'competition_id' => $competition->id,
                        'group_at' => $i,
                        'stage' => 'group',
                        'team_id' => $h,
                        'against_team' => $a,
                        'score_for' => 0,
                        'score_against' => 0,
                    ]);
                }
            }
        }

        return back();
    }


    public function rollback($slug)
    {
        $com = Competition::where('slug', $slug)->first();
        Matche::where('competition_id', $com->id)->delete();
        return back();
    }
}
