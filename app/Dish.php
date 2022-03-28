<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Dish extends Model
{
    protected $fillable = [
        'name',
        'image',
        'description',
        'price',
        'visibility'
    ];

    static function slugGenerator($name, $user_id)
    {
        $newSlug = Str::slug($name, '-');

        $counter = 0;
        while (Dish::where('user_id', $user_id)->where('slug', $newSlug)->first()) {
            $newSlug = Str::slug($name . '-' . $counter, '-');
            $counter++;
        }

        return $newSlug;
    }

    public function users()
    {
        return $this->belongsTo('App\User');
    }

    public function dishImages()
    {
        return $this->hasMany('App\DishImage');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }
    
}
