<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User\User;
use App\Models\User\UserGameRecord;
use App\Models\User\UserGameHistory;
use DB;

class GameRecord extends Model
{
    use HasFactory;

    //Default timestamps set false
    public $timestamps = false;

    /**
     *  Can be filled
     *
     * @var array<dateTime>
     */
    protected $fillable = ['game_date', ];

    /**
     * Get Top 10 players from database.
     *
     * @return array
     */
    protected function getTop10()
    {
        return User::leftJoin('user_game_details','users.id','=','user_game_details.user_id')
                ->leftJoin('user_game_histories','user_game_histories.user_id','=','users.id')
                ->selectRaw('users.id, users.username, users.tel, users.email, user_game_details.average_score, user_game_details.total_win, user_game_details.total_loss, MAX(user_game_histories.score) as highest_score, COUNT(user_game_histories.user_id) AS ttl_match')
                ->groupBy('users.id')
                ->havingRaw('ttl_match > 10')
                ->orderBy('user_game_details.average_score', 'DESC')
                ->limit(10)
                ->get();
    }
}
