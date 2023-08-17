<?php

namespace App\Http\Controllers\Competition;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FinalController extends Controller
{
    //
    public function  index($slug){
        return view('competition.final');
    }
}
