<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePosters extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'link',
    ];
    protected $appends = [
        'image_full_path'
      ];


    public function getImageFullPathAttribute()
    {
        return $this->image ? env('APP_URL') . '/uploads/generals/' . $this->image : null;
    }
}
