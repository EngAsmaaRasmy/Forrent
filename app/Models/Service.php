<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    public $fillable = [
        'title',
        'description',
        'price',
        'image',
        'period_unit',
        'discount',
        'discount_period',
        'area_id',
        'sub_category_id',
        'service_provider_id',
        'disabled',
        'allow',
        'start_date',
        'end_date',
      ];
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
    public function serviceProvider()
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function favorite()
    {
        $customer_id = session('id') ;
        return $this->belongsTo(CustomerServiceFavorite::class, 'id', 'service_id')->where('customer_id', $customer_id);
    }

    public function rate()
    {
        $customer_id = session('id') ;
        return $this->belongsTo(Rating::class, 'id', 'service_id')->where('customer_id', $customer_id);
    }
    protected $appends = [
        'title_ar', 'description_ar', 'image_full_path','slug','new_price'
      ];

    public function getTitleArAttribute()
    {
        $translation = Translation::where('model', 'Service')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'title')
        ->first();

        return $translation ? $translation->value : null;
    }

    public function getDescriptionArAttribute()
    {
        $translation = Translation::where('model', 'Service')
        ->where('row_id', $this->attributes['id'])
        ->where('field', 'description')
        ->first();

        return $translation ? $translation->value : null;
    }
    public function getSlugAttribute()
    {
        $slug = Slug::where('model', 'Service')
        ->where('row_id', $this->attributes['id'])
        ->first();

        return $slug ? $slug->value : null;
    }
    public function getImageFullPathAttribute()
    {
        return $this->image ? env('APP_URL')  . 'uploads/' . $this->image : null;
    }

    public function getNewPriceAttribute()
    {
        $price = (float)$this->price;
        $discount = (float)$this->discount;
        $total = ($price - $discount);
        return  number_format($total);
    }

    public function getPriceAttribute()
    {
        $price = (float)$this->attributes['price'];
        return  number_format($price);
    }
}