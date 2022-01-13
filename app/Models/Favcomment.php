<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favcomment extends Model
{
    public $table = 'favcomments';



    public $fillable = [
        'status',


    ];


    public function commentvouchers()
    {
        return $this->hasMany(Commentvoucher::class, 'favcomment_id', 'id');
    }


}
