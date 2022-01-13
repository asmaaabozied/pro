<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Commentvoucher extends Model
{



    public $table = 'commentvouchers';



    public $fillable = [
        'comment',
        'review',
        'user_id',
        'voucher_id',
        'favcomment_id',
        'like1',
        'dislike'

    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->select('id','name','image');
    }


    public function Capon()
    {
        return $this->belongsTo(Capon::class, 'capon_id', 'id');
    }


    public function Favcomment()
    {
        return $this->belongsTo(Favcomment::class, 'favcomment_id', 'id');
    }



}
