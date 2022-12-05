<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfoUs extends Model
{
    use HasFactory;

    public $fillable = [
        'phone',
        'email',
        'address',
        'about',
    ];

    protected $appends = [
        'about_ar','address_ar'
    ];

      public function getAboutArAttribute()
    {
        $translation = Translation::where('model', 'InfoUs')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'about')
        ->first();

        return $translation ? $translation->value : null;
    }
    public function getAddressArAttribute()
    {
        $translation = Translation::where('model', 'InfoUs')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'address')
        ->first();

        return $translation ? $translation->value : null;
    }
}
