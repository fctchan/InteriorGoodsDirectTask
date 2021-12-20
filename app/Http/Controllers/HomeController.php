<?php

namespace App\Http\Controllers;

use App\Models\User\User;
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
        // Get players with highest average score, include total wins, losses, matches, and highest score

        // Ordering by a relationship is tricky, I can think of two solutions

        // The below keeps everything very clean, but it's doing it all at the application layer, rather than database layer.
        // The result being that your code would be more performant than this, especially at scale
        //
        // I have comented this out as not performance
//        $players = User::with('gameDetails')
//            ->get()
//            ->sortByDesc('gameDetails.average_score')
//            ->take(10);

        // Alternatively, we can build the query up manually
        $players = User::with('gameDetails')
            ->select('users.*')
            ->join('user_game_details', 'user_game_details.user_id', 'users.id')
            ->orderByDesc('user_game_details.average_score')
            ->limit(10)
            ->get();

        // The perfect solution would be that the 'UserGameDetail' model didn't exist and all information is stored on the 'User' table
        // Typically, wherever there is a 'hasOne' relationship, means that info could have been stored on the linked table
        // That would have resulted in code like this... Which IMO is the cleanest of the three
//        $players = User::with('gameDetails')
//            ->orderByDesc('average_score')
//            ->limit(10)
//            ->get();

        return view('home', compact('players'))->with('seq', 1);;
    }

}
