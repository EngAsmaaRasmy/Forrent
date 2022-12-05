<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'token',
        'otp',
      ];

      public function reviews()
      {  
        return $this->hasOne(Rating::class);
      }
}
