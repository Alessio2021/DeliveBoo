<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Dish extends Model
{
    protected $fillable = [
        'restaurant_id',
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

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
