<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DetailPemesanan extends Migration
{
    public function up()
    {
        Schema::create('detail_pemesanan', function (Blueprint $table) {
            $table->increments('id_detail');
            $table->string('id_pemesanan');
            $table->string('id_tiket');
            $table->string('total');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('detail_pemesanan');
    }
}
