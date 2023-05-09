<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $fillable =[
        'number_of_stars',
        'body',
        'user_id',
        'menu_item_id',
        
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
