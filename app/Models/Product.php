<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * Define the relationship between Product and Size.
     */
    public function sizes()
    {
        return $this->belongsToMany(Size::class);
    }

    /**
     * Define the relationship between Product and Color.
     */
    public function colors()
    {
        return $this->belongsToMany(Color::class);
    }
}

