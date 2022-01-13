<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    public $table = 'settings';

    public $fillable = [ 'phone','email','instegram','twitter','facebook','snapchat'];

}
