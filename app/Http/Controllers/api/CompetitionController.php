<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\AllowedCountries;
use App\Models\Competition;
use App\Models\CompetitionTeams;
use App\Models\Group;
use App\Models\Session;
use App\Models\Team;
use Illuminate\Http\Request;

class CompetitionController extends Controller
{
    public function all(Request $request)
    {
        $competitions = Competition::select('id', 'name', 'slug', 'max_teams', 'group_count', 'created_at', 'winner')->get();
        return response()->json(['competition' => $competitions]);
    }

    public function detail($slug)
    {
        $competitions = Competition::where('slug', $slug)->first();

        return response()->json([
            'id' => $competitions->id,
            'name' => $competitions->name,
            'slug' => $competitions->slug,
            'max_teams' => $competitions->max_teams,
            'group_count' => $competitions->group_count,
            'created_at' => $competitions->created_at,
            'allowed_countries' => $competitions->countries->setHidden(['created_at', 'updated_at', 'laravel_through_key']),
            'winner' => $competitions->winner,
        ]);
    }
    public function register(Request $request, $slug)
    {
        $session = Session::where('api_token', $request->bearerToken())->first();
        $team = Team::find($session->team_id);
        $compet = Competition::where('slug', $slug)->first();
        $competTeam = CompetitionTeams::where('competition_id', $compet->id)->count();

        if (!$team) {
            return response()->json(['message', 'Team not found']);
        }

        $allowedCountryId = AllowedCountries::where('competition_id', $compet->id)->pluck('countrie_id')->toArray();

        if ($competTeam >= $compet->max_teams) {
            return response()->json(['message' => 'The competition is already full']);
        }

        if (!in_array($team->countrie_id, $allowedCountryId)) {
            return response()->json(['message' => 'Your country is not allowed to join this']);
        }

        if (Group::where('competition_id', $compet->id)->where('team_id', $team->id)->exists()) {
            return response()->json(['message' => 'Your team is already joined the competition']);
        }

        CompetitionTeams::create([
            'competition_id' => $compet->id,
            'team_id' => $team->id,
        ]);

        return response()->json(['message' => 'Registration success']);
    }
}
