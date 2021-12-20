<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGameHistory extends Model
{
    use HasFactory;

    //Default timestamps set false
    public $timestamps = false;

    /**
     * Can be filled
     *
     * @var array<int, int, string, int>
     */
    protected $fillable = ['user_id', 'game_record_id', 'result', 'score', ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function gameRecord()
    {
        return $this->belongsTo(GameRecord::class);
    }
}
