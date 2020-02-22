<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    protected $guarded=['id_penumpang','created_at','updated_at'];
}
