<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\Models\MoviePick;

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
