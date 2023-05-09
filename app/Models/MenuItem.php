<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
        'price',
        'category_id'
    ];
    public function reviews(){
        return $this->hasMany(Review::class);
    }
    public function offers(){
        return $this->hasMany(Offer::class);
    }
    public function images(){
        return $this->hasMany(MenuItemImage::class);
    }

}
