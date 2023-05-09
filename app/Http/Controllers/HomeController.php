<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::all();
                    // ->whereYear('created_at', date('Y'))
                    // ->groupBy(DB::raw("Month(created_at)"))
                    // ->pluck('id', 'name');
 
        // $labels = $users->keys();
        // dd($user);
        $data = $user;
              
        // return view('home')->with(["data" => $data , 'user' => $user ]) ;
        return view('home');
    }
}
