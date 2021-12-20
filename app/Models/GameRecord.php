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

    //Use table
    protected $table = 'game_record';

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
        return User::leftJoin('user_game_detail','user.uid','=','user_game_detail.FK_uid')
                ->leftJoin('user_game_history','user_game_history.FK_uid','=','user.uid')
                ->selectRaw('user.uid, user.username, user.tel, user.email, user_game_detail.average_score, user_game_detail.total_win, user_game_detail.total_loss, MAX(user_game_history.score) as highest_score, COUNT(user_game_history.FK_uid) AS ttl_match')
                ->groupBy('user.uid')
                ->havingRaw('ttl_match > 10')
                ->orderBy('user_game_detail.average_score', 'DESC')
                ->limit(10)
                ->get();
    }
}
