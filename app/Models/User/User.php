<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    use HasFactory;

    //Use table
    protected $table = 'user';

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
        $user = User::orderBy('uid', 'ASC')->get();

        return $user;
    }    

    /**
     * Create new player into database
     * 
     * return bool
     */
    protected function creatNewPlayer($user){
        //Insert data into database
        if ($user->save()){
            return true;
        }else {
            return false;
        }
    }

    /**
     * Browse player information
     * 
     * return array $user
     */
    protected function showUser($uid){

        //Get selected player data from database
        $user = User::where('uid', $uid)
            ->leftJoin('user_game_detail','user.uid','=','user_game_detail.FK_uid')
            ->leftJoin('user_game_history','user_game_history.FK_uid','=','user.uid')
            ->selectRaw('user.uid, user.username, user.tel, user.email, user_game_detail.average_score, user_game_detail.total_win, user_game_detail.total_loss, MAX(user_game_history.score) as highest_score, COUNT(user_game_history.FK_uid) AS ttl_match')
            ->groupBy('user.uid')
            ->orderBy('user_game_detail.average_score', 'DESC')
            ->get();

        return $user;
    }

    /**
     * Browse player highest score
     * 
     * return array $highestRecord
     */
    protected function showUserHighesrScore($uid, $highest_score){

        //Get player highest score data from database
        $highestRecord = DB::select("SELECT gr.game_date, ugh1.FK_game_record_id, ugh1.result as player1Result , u.username, ugh2.result as player2Result 
                            FROM game_record as gr  
                            inner join (select FK_game_record_id, result from user_game_history where score = ".$highest_score." and FK_uid = ".$uid.") as ugh1 on ugh1.FK_game_record_id = gr.game_record_id 
                            inner join user_game_history as ugh2 on gr.game_record_id = ugh2.FK_game_record_id 
                            left join user as u on u.uid = ugh2.FK_uid
                            where ugh2.FK_game_record_id = ugh1.FK_game_record_id and u.uid != ".$uid.";");

        return $highestRecord;
    }
    
    /**
     * Browse player profile information
     * 
     * return array $user
     */
    protected function getUser($uid){

        //Get selected player data from database
        $user = User::where('uid', $uid)->get();

        return $user;
    }

    /**
     * Browse player profile information
     * 
     * return bool
     */
    protected function updateUser($uid, $user){

        //Get selected player data from database
        if (User::where('uid', $uid)->update(array('tel' => $user->tel, 'email'=> $user->email))){
            return true;
        }else{
            return false;
        }
    }
}
