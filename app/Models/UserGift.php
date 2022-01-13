<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGift extends Model
{
    public $table = 'user_gift';
    
    public $fillable = [
        'title',
        'description',
        'referral_count',
        'user_id',
    ];
}
