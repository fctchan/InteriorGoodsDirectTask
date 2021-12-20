<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GameRecord;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the Top 10 players.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $players = GameRecord::getTop10();
        return view('home', compact('players'))->with('seq', 1);;
    }

}
