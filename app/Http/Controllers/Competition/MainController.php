<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use App\Models\AllowedCountries;
use App\Models\Competition;
use App\Models\Countries;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        $competitions['competitions'] = Competition::with('allowed.countries')->get();
        // dd($competitions);
        return view('competition', $competitions);
    }

    public function create()
    {
        $countries['countries'] = Countries::all();
        return view('competition.create', $countries);
    }

    public function store(Request $request)
    {

        // dd($request);
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:competitions',
            'max_teams' => 'required|integer|min:6',
            'group_count' => 'required|integer|between:2,255',
            'allowed_countries' => 'required',
        ]);

        $slug = str_replace(' ', '-', strtolower($request->slug));

        $team = $request->max_teams / $request->group_count;
        if (is_float($team)) {
            return redirect('/comptitions/create')->withErrors(['errors' => 'The number of teams should be evenly divisible by the group count'])->withInput();
        }

        $competitions = Competition::create([
            'name' => $request->name,
            'slug' => $slug,
            'max_teams' => $request->max_teams,
            'group_count' => $request->group_count,
        ]);

        foreach ($request->allowed_countries as $rel) {
            AllowedCountries::create([
                'competition_id' => $competitions->id,
                'countrie_id' => (int) $rel,
            ]);
        }

        return redirect('/competitions')->withSuccess('Competition created successfully.');
    }

    public function show($slug)
    {
        $competitions['competitions'] = Competition::where('slug', $slug)->with('allowed.countries')->with('groups.teams')->first();
        // dd($competitions);
        return view('competition.detail', $competitions);
    }
}
