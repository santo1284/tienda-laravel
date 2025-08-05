<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', "statu"];

    public function products(): HasMany{
        return $this->hasMany(Product::class);
    }

}
