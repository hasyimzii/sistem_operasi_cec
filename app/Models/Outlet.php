<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Outlet extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->hasMany('App\Models\User');
    }

    public function history()
    {
        return $this->hasMany('App\Models\History');
    }
    
    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function expense()
    {
        return $this->hasMany('App\Models\Expense');
    }
}
