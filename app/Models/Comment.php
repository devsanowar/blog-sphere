<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    protected $fillable = ['blog_id', 'name', 'email', 'comment_text', 'image'];
}
