<?php

namespace App\Http\Controllers;

use App\Models\GameRecord;
use Illuminate\Http\Request;

class GameRecordController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gameRecord = new GameRecord;
        $user->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GameRecord  $gameRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy(GameRecord $gameRecord)
    {
        //
    }
}
