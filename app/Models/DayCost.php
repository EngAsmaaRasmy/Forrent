<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayCost extends Model
{
    use HasFactory;

    protected $fillable = [
        'cost',
    ];

    public function getCostAttribute($cost)
    {
        return  number_format($cost);
    }
}
