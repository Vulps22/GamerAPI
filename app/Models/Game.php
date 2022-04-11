<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        "name", "steamID", "icon_url", 'created_by'
    ];

     /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'created_by', 'created_at', 'updated_at'
    ];
}
