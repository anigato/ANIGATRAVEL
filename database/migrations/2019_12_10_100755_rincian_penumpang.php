<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RincianPenumpang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('identitass', function (Blueprint $table) {
            $table->increments('id_identitas');
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('tipe_identitas');
            $table->string('no_identitas');
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
        Schema::dropIfExists('identitass');
    }
}

