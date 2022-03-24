<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'PIVA',
        'address',
        'image',
        'slug',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    static function slugGenerator($name)
    {
        $newSlug = Str::slug($name, '-');
        $counter = 0;

        while (User::where('slug', $newSlug)->first()) {
            $newSlug = Str::slug($name . '-' . $counter, '-');
            $counter++;
        }

        return $newSlug;
    }

    public function dish()
    {
        return $this->hasMany('App\Dish');
    }
}
