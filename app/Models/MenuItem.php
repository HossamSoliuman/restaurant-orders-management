<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuItem extends Model
{
    use HasFactory , SoftDeletes;
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id'
    ];
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
    public function images()
    {
        return $this->hasMany(MenuItemImage::class, 'menu_item_id', 'id');
    }
    public function getRatingAttribute()
    {
        if ($this->reviews->count()) {
            $sum = $this->reviews->sum('number_of_stars');
            $avg = $sum / $this->reviews->count();
            return round($avg, 1);
        }
        return 5;
    }
}
