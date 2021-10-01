<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ingredient()
    {
        return $this->hasMany(Ingredient::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }
}
