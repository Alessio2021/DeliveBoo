<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable =
    [
        'guest_address',
        'email',
        'message',
        'dishes',
        'restaurant_name',
        'amount'
    ];
}
