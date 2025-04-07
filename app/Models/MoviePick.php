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

    public function movieRatings()
    {
        return $this->hasMany(MovieRating::class);
    }

    public function getAverageRating()
    {
        $rating = $this->movieRatings()->avg('rating');
        return $rating ? number_format($rating, 2) : null;
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
