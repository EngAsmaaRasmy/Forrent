<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    public $fillable = [
        'rating',
        'service_id',
        'customer_id',
    ];
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
