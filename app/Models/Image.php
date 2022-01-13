<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

    protected $table = 'images';
    public $timestamps = true;
    protected $fillable = array('imageable_id', 'imageable_type', 'image');



    public function imageable()
    {
        return $this->morphTo();
    }


}
