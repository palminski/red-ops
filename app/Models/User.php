<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\MoviePick;
use App\Models\movieRating;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'username',
        'hashed_password'
    ];

    protected $hidden = [
        'hashed_password'
    ];

    public function moviePicks()
    {
        return $this->hasMany(MoviePick::class);
    }

    public function movieRatings()
    {
        return $this->hasMany(MovieRating::class);
    }

    public function getAverageScore()
    {
        $movies = $this->moviePicks;

        if ($movies->isEmpty()) 
        {
            return 0.00;
        }

        $totalRatingAvg = $movies->map(function ($movie) {
            return $movie->getAverageRating();
        })->filter()->avg();

        return number_format($totalRatingAvg, 2);
    }

    public function getAuthPassword()
    {
        return $this->hashed_password;
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
