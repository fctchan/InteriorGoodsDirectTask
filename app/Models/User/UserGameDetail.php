<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGameDetail extends Model
{
    use HasFactory;

    //Use table
    protected $table = 'user_game_detail';

    //Default timestamps set false
    public $timestamps = false;

    /**
     * Can be filled
     * 
     * @var array<int, int, int, int>
     */
    protected $fillable = ['FK_uid', 'average_score', 'total_win', 'total_loss', ];
}
