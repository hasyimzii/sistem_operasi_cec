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
    
    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function expense()
    {
        return $this->hasMany(Expense::class);
    }
}
