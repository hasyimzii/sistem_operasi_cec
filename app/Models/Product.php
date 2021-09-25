<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];

    public function outlet()
    {
        return $this->belongsTo('App\Models\Outlet');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function sale()
    {
        return $this->hasMany('App\Models\Sale');
    }
}
