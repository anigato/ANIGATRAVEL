<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Tempat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tempats', function (Blueprint $table) {
            $table->increments('id_tempat');
            $table->string('tempat_awal');
            $table->string('kode_tempat_awal');
            $table->string('tempat_akhir');
            $table->string('kode_tempat_akhir');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tempats');
    }
}
