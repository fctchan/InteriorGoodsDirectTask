<?php

namespace App\Http\Controllers\User;

use DB;
use App\Models\User\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Schema;

class UserController extends Controller
{
    /**
     * Display a listing of all user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User.userlist');
    }

    /**
     * Show create new player form.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User.create');
    }

    /**
     * Create a new player into table.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        //Validation for input
        $request->validate([
            'username' => 'required|unique:user|min:1',
            'telephone' => 'required',
            'email' => 'required|email',
        ]);

        //Insert data into database
        $user = new User;
        $user->username = request('username');
        $user->tel = request('telephone');
        $user->email = request('email');
        $user->save();

        return view('User.userlist')->with('newPlayerName', $user->username);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($uid)
    {
        //Get selected player data from database
        $user = User::where('uid', $uid)
            ->leftJoin('user_game_detail','user.uid','=','user_game_detail.FK_uid')
            ->leftJoin('user_game_history','user_game_history.FK_uid','=','user.uid')
            ->selectRaw('user.uid, user.username, user.tel, user.email, user_game_detail.average_score, user_game_detail.total_win, user_game_detail.total_loss, MAX(user_game_history.score) as highest_score, COUNT(user_game_history.FK_uid) AS ttl_match')
            ->groupBy('user.uid')
            ->orderBy('user_game_detail.average_score', 'DESC')
            ->get();

        //Get highest score
        $highest_score = $user[0]->highest_score;

        //Get player highest score data from database
        $highestRecord = DB::select("SELECT gr.game_date, ugh1.FK_game_record_id, ugh1.result as player1Result , u.username, ugh2.result as player2Result 
                            FROM game_record as gr  
                            inner join (select FK_game_record_id, result from user_game_history where score = ".$highest_score." and FK_uid = ".$uid.") as ugh1 on ugh1.FK_game_record_id = gr.game_record_id 
                            inner join user_game_history as ugh2 on gr.game_record_id = ugh2.FK_game_record_id 
                            left join user as u on u.uid = ugh2.FK_uid
                            where ugh2.FK_game_record_id = ugh1.FK_game_record_id and u.uid != ".$uid.";");
        
        return view('User.gameRecord', compact('user', 'highestRecord'));                    
    }

    /**
     * Show edit selected user information.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($uid)
    {   
        //Get player information from database
        $user = User::where('uid', $uid)->get();
        return view('User.edit')->with('user', $user);
    }

    /**
     * Update specified player's new data into the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uid)
    {   
        //Validation for input
        $request->validate([
            'telephone' => 'required',
            'email' => 'required|email',
        ]);

        //find the player by uid and update the data
        User::where('uid', $uid)->update(array('tel' => request('telephone'), 'email'=> request('email')));

        //redirect to edit page and pass the update success notice
        return redirect()->route('User.edit', [$uid])->with('success', true);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
