<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public const USER = 1;
    public const ADMIN = 2;
    public const REVIEWER = 3;
    public const CHEF = 4;
    public const DELIVERY = 5;
    protected $fillable = [
        'name',
    ];
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
