<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DishImage extends Model
{ 
    protected $fillable = [
        'dish_id',
        'img_path'
    ];

    public function dish()
    {
        return $this->belongsTo('App\Dish');
    }
}
