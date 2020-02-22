<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Rute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutes', function (Blueprint $table) {
            $table->increments('id_rute');
            $table->string('tujuan');
            $table->string('rute_awal');
            $table->string('rute_akhir');
            $table->date('id_transportasi');           
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
        Schema::dropIfExists('rutes');
    }
}
