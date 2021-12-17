<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
