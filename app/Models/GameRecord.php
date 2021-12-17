<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
