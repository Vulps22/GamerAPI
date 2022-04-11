<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerGame extends Model
{
    protected $fillable = [
        "gameID", "userID"
    ];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
