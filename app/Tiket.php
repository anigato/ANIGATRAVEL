<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    protected $guarded = ['id_tiket','created_at','updated_at'];
}
