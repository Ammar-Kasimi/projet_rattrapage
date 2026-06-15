<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function events()
    {
        return $this->hasMany(Event::class);
    }
    protected $fillable = [
        'location',
        'country',
        "city",
        'postal_code'
    ];
}
