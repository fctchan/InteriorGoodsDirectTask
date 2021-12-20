<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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

    public function gameHistories()
    {
        return $this->hasMany(UserGameHistory::class);
    }
}
