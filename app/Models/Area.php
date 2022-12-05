<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'city_id'
    ];
    
    protected $appends = [
        'name_ar'
    ];  


    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function getNameArAttribute()
    {
        $translation = Translation::where('model', 'Area')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'name')
        ->first();

        return $translation ? $translation->value : null;
    }
}
