<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\Competition;
use App\Models\CompetitionTeams;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function standing($slug)
    {
        $competitions = Competition::where('slug', $slug)->first();
        $group = Group::where('competition_id', $competitions->id)->orderby('group_at', 'ASC')->get();
        $groupRel = $group->groupBy('group_at');
        return view('competition.standing', compact(['groupRel'], ['competitions']));
    }

    public function allocateTeams($slug)
    {
        $competitions = Competition::where('slug', $slug)->first();
        $comTeams = CompetitionTeams::where('competition_id', $competitions->id)->get();

        if ($comTeams->count() !== $competitions->max_teams) {
            return back()->withErrors(['errors' => 'Teams is not fully.']);
        }

        Group::where('competition_id', $competitions->id)->delete(); // Delete group dupicate

        $teams = CompetitionTeams::where('competition_id', $competitions->id)->inRandomOrder()->get(); // random team in competition team.

        $teamsPerGroup = intval(ceil($competitions->max_teams / $competitions->group_count)); // $4 = 16 / 4

        for ($i = 1; $i <= $competitions->group_count; $i++) {
            $groupTeams = $teams->splice(0, $teamsPerGroup);

            foreach ($groupTeams as $g) {
                Group::create([
                    'group_at' => $i,
                    'competition_id' => $competitions->id,
                    'team_id' => $g->team_id,
                ]);
            }

        }
        return back();
    }

    public function rollbackGroup($slug){
        $competitions = Competition::where('slug', $slug)->first();
        $competitions->groups()->delete(); // groups method in model

        return back();
    }
}
