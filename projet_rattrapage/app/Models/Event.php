<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;;
class Event extends Model
{
    use SoftDeletes;
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
    'desc',
    'date',
    'max_volunteers',
    "address_id",
    'user_id',
    'category_id',
    'picture'
    ];
}
