<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'phone',
        'email',
        'password',
        'token',
        'otp',
        'address',
        'account_type_id',
        'document1',
        'document2',
        'blocked'
      ];
      public function review()
    {
        return $this->hasOne(ReviewServiceProvider::class);
    }
}
