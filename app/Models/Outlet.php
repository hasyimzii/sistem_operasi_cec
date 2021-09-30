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
        return $this->hasMany(User::class);
    }

    public function history()
    {
        return $this->hasMany(History::class);
    }
    
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
