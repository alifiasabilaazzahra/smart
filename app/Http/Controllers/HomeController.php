<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->is_role == 'Teacher'){
            return redirect('/guru');
        }
        elseif(Auth::user()->is_role == 'Student'){
            return redirect('/siswa');
        }
        elseif(Auth::user()->is_role == 'Admin'){
            return redirect('/admin');
        }
        else{
            return redirect('/');
        }
    }
}
