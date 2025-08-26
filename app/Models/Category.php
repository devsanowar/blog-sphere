<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'category_id');
    }
}
