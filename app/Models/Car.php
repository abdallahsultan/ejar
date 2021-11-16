<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'keywords',
        'description',
        'image',
        'category_id',
        'detail',
        'user_id',
        'brand_id',
        'brand',
        'model',
        'year',
        'price',
        'licance_plate',
        'engine_power',
        'fuel_type',
        'color',
        'gear_type',
        'slug',
        'status	',
    ];

    #One to Many (Inverse)
    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
   

    protected $appends=['path'];
    public function getPathAttribute()
    {
        if($this->image)
        {
            return asset("storage/$this->image");
        }
        else {            
            return asset('assets/images/cat_default.png');
        }

    }
}
