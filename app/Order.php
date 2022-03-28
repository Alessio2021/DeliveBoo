<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'guest_address',
        'payment_method',
        'total_amount',
        'created_at',
        'updated_at	'
    ];

    public function dishes()
    {
        return $this->belongsToMany('App\Dish');
    }
}
