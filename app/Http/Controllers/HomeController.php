<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\UserGameRecord;
use App\Models\User\UserGameHistory;
use DB;

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
        $players = $this->getTop10();
        return view('home', compact('players'))->with('seq', 1);;
    }

    /**
     * Get Top 10 players from database.
     *
     * @return array
     */
    private function getTop10()
    {
        $players = User::leftJoin('user_game_detail','user.uid','=','user_game_detail.FK_uid')
                ->leftJoin('user_game_history','user_game_history.FK_uid','=','user.uid')
                ->selectRaw('user.uid, user.username, user.tel, user.email, user_game_detail.average_score, user_game_detail.total_win, user_game_detail.total_loss, MAX(user_game_history.score) as highest_score, COUNT(user_game_history.FK_uid) AS ttl_match')
                ->groupBy('user.uid')
                ->havingRaw('ttl_match > 10')
                ->orderBy('user_game_detail.average_score', 'DESC')
                ->limit(10)
                ->get();

        return $players;
    }

}
