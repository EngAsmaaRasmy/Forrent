<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $fillable = [
        'name'
    ];

    protected $appends = [
        'name_ar'
    ];  


    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function getNameArAttribute()
    {
        $translation = Translation::where('model', 'City')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'name')
        ->first();

        return $translation ? $translation->value : null;
    }
}
