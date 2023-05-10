<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'description',
        'type',
        'amount',
        'menu_item_id',
        'start_at',
        'end_at',
    ];
    public function menuItem(){
       return  $this->belongsTo(MenuItem::class);
    }
    public function offerType(){
        return $this->hasOne(OfferType::class);
    }
}
