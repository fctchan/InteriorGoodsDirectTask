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
        $user = User::getAllUser();

        return view('User.userlist')->with('users', $user);
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

        //Prepare the data to insert into database
        $user = new User;
        $user->username = request('username');
        $user->tel = request('telephone');
        $user->email = request('email');

        //Call function to data into database
        $saveResult = $user->save();

        //get all user to user list
        $users = User::getAllUser();

        //Render saving action result
        if ($saveResult){
            return view('User.userlist')->with('newPlayerName', $user->username)->with('users', $users);
        }

        return view('User.create')->with('errorConnectDB', 'createNew')->with('users', $users);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('gameDetails');

        return view('User.gameRecord', compact('user'));

        //Get highest score
        $highest_score = $user[0]->highest_score;

        //Get player highest score data from database
        if ($highest_score != 0){
            $highestRecord = User::showUserHighesrScore($id, $highest_score);
            //Render result page with highest score
            return view('User.gameRecord', compact('user', 'highestRecord'));
        }else{
            //Render result page without playing any game
            return view('User.gameRecord', compact('user'));
        }
    }

    /**
     * Show edit selected user information.
     *
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Get player information from database
        $user = User::getUser($id);

        //return user information and render page
        return view('User.edit')->with('user', $user);
    }

    /**
     * Update specified player's new data into the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validation for input
        $request->validate([
            'telephone' => 'required',
            'email' => 'required|email',
        ]);

        $user = new User;
        $user->tel = request('telephone');
        $user->email = request('email');

        //find the player by uid and update the data
        $updateResult = User::updateUser($id, $user);

        //redirect to edit page and pass the update success notice
        if($updateResult){
            return redirect()->route('User.edit', [$id])->with('success', true);
        }else {
            return redirect()->route('User.edit', [$id])->with('success', false);
        }

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
