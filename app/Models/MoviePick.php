<?php

namespace App\Models;
use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Model;

use App\Models\User;

class MoviePick extends Model
{

    protected $fillable = [
        'uuid',
        'user_id',
        'movie_title'
    ];

    public $incrementing = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot() {
        parent::boot();

        static::creating(function ($model){
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }
}
