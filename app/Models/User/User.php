<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    use HasFactory;

    //Default timestamps set false
    public $timestamps = false;

    /**
     * Can be filled
     *
     * @var array<string, int, string>
     */
    protected $fillable = ['username', 'tel', 'email', ];

    /**
     * Get all user information
     *
     * return array $user
     */
    protected function getAllUser(){
        //Get all user data from database
        return User::orderBy('id', 'ASC')->get();
    }

    /**
     * Create new player into database
     *
     * return bool
     */
    protected function creatNewPlayer($user){
        //Insert data into database
        return $user->save();
    }

    /**
     * Browse player information
     *
     * return array $user
     */
    protected function showUser($id){
        //Get selected player data from database
        return User::where('users.id', $id)
            ->leftJoin('user_game_details','users.id','=','user_game_details.user_id')
            ->leftJoin('user_game_histories','user_game_histories.user_id','=','users.id')
            ->selectRaw('users.id, users.username, users.tel, users.email, user_game_details.average_score, user_game_details.total_win, user_game_details.total_loss, MAX(user_game_histories.score) as highest_score, COUNT(user_game_histories.user_id) AS ttl_match')
            ->groupBy('users.id')
            ->orderBy('user_game_details.average_score', 'DESC')
            ->get();
    }

    /**
     * Browse player highest score
     *
     * return array $highestRecord
     */
    protected function showUserHighesrScore($id, $highest_score){
        //Get player highest score data from database
        return DB::select("SELECT gr.game_date, ugh1.game_record_id, ugh1.result as player1Result , u.username, ugh2.result as player2Result
                            FROM game_records as gr
                            inner join (select game_record_id, result from user_game_histories where score = ".$highest_score." and user_id = ".$id.") as ugh1 on ugh1.game_record_id = gr.id
                            inner join user_game_histories as ugh2 on gr.id = ugh2.game_record_id
                            left join users as u on u.id = ugh2.user_id
                            where ugh2.game_record_id = ugh1.game_record_id and u.id != ".$id.";");
    }

    /**
     * Browse player profile information
     *
     * return array $user
     */
    protected function getUser($id){

        //Get selected player data from database
        return User::where('id', $id)->get();
    }

    /**
     * Browse player profile information
     *
     * return bool
     */
    protected function updateUser($id, $user){
        return User::where('id', $id)->update(array('tel' => $user->tel, 'email'=> $user->email));
    }
}
