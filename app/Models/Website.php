<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Website can have many Posts.
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // Website can have many Subscribers (Users).
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'subscriptions');
    }
}
