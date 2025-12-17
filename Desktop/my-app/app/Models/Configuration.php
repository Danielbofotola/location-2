<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $fillable = [
        'service',
        'price_cdf',
        'price_usd',
    ];
}
