<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $fillable = [
      'name',
      'image',
      'description',
      'poster_image',
      'poster_link',
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }

    protected $appends = [
      'name_ar', 'description_ar', 'slug','image_full_path', 'poster_image_full_path'
    ];

    public function getNameArAttribute()
    {
        $translation = Translation::where('model', 'Category')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'name')
        ->first();

        return $translation ? $translation->value : null;
    }

    public function getDescriptionArAttribute()
    {
        $translation = Translation::where('model', 'Category')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'description')
        ->first();

        return $translation ? $translation->value : null;
    }

    public function getSlugAttribute()
    {
        $slug = Slug::where('model', 'Category')
        ->where('row_id', $this->attributes['id'])
        ->first();

        return $slug ? $slug->value : null;
    }
    public function getImageFullPathAttribute()
    {
        return $this->image ? env('APP_URL') . '/uploads/' . $this->image : null;
    }
    public function getPosterImageFullPathAttribute()
    {
        return $this->image ? env('APP_URL') . '/uploads/posters/' . $this->image : null;
    }


}
