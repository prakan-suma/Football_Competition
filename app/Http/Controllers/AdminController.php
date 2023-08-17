<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function loginForm()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $admin = Admin::where([
            ['username', $request->username],
            ['password', $request->password],
        ])->first();

        if (!$admin) {
            return back()->withErrors(['errors' => 'Useranme or password is incorrect']);
        }

        session(['admin' => $admin]);

        return redirect('/competitions');
    }

    public function logout()
    {
        session()->flush();
        return redirect('/login');
    }
}
