<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'code' => 'required|unique:teams',
            'country_id' => 'required',
            'logo' => 'required|mimes:png,jpg',
            'password' => 'required|min:6',
            'password_comfirmation' => 'required|min:6'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid field', 'errors' => $validator->errors()->first()], 401);
        } elseif ($request->password != $request->password_comfirmation) {
            return response()->json(['message' => 'Invalid field', 'errors' => 'Password not macth'], 401);
        }


        // Save logo
        $logo = $request->file('logo')->move('public/logo', $request->file('logo')->getClientOriginalName());

        $team = Team::create([
            'name' => $request->name,
            'code' => $request->code,
            'countrie_id' => $request->country_id,
            'logo' => $logo,
            'password' => $request->password,
        ]);


        $session = Session::create([
            'team_id' => $team->id,
            'api_token' => Str::uuid(),
        ]);

        return response()->json(['message' => 'Register success', 'accessToken' => $session->api_token], 200);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid field', 'errors' => $validator->errors()->first()], 401);
        }

        $team = Team::where(
            [
                ['code', $request->code],
                ['password', $request->password],
            ]
        )->first();



        if (!$team) {
            return response()->json(['message' => 'Code or password incorrect'], 401);
        }

        $session = Session::create([
            'team_id' => $team->id,
            'api_token' => Str::uuid(),
        ]);

        return response()->json(['message' => 'Register success', 'accessToken' => $session->api_token], 200);
    }

    public function logout(Request $request)
    {
        $session = Session::where('api_token', $request->bearerToken())->first();

        if (!$session) {
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $session->delete();
        return response()->json(['message' => 'Logout success'], 200);
    }
}
