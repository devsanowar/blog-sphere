<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $guarded = ['id'];

    protected $fillable = [
        'name',
        'position',
        'phone',
        'email',
        'adjective',
        'facebook_url',
        'linkedin_url',
        'instagram_url',
        'twitter_url',
        'pinterest_url',
        'image',
        'status',
    ];
}
