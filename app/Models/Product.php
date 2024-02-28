<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'category_id',
        'image',
        'targeted_number',
        'amount',
        'user_id',
        'agent_id',
        'customer_id',

    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}