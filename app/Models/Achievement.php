<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class Achievement extends Model
{

    // protected $fillable = [
    //     'uuid',
    //     'user_id',
    //     'movie_title'
    // ];

    // public $incrementing = false;

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    
}
