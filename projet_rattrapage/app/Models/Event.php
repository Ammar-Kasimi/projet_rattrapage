<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function volunteers()
    {
        return $this->belongsToMany(User::class, 'participations')->withTimestamps();
    }
    protected $fillable = [
    'title',
    'description',
    'date',
    'location',
    'user_id',
    'picture'
    ]
}
