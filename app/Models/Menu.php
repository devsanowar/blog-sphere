<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = ['id'];

    public function categories()
    {
        return $this->hasMany(Category::class, 'menu_id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'menu_id');
    }

}
