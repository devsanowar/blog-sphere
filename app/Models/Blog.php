<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;
use App\Models\Comment;

class Blog extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


}
