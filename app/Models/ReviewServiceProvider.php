<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewServiceProvider extends Model
{
    use HasFactory;

    public $fillable = [
      'review',
      'service_provider_id'
    ];

    public function service_provider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
