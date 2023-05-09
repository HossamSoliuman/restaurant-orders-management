<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItemImage extends Model
{
    use HasFactory;
    protected $fillable =[
        'path',
        'menu_item_id',
    ];
    public function menuItem(){
        return $this->belongsTo(MenuItem::class);
    }
}
