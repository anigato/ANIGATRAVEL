<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Penumpang extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penumpangs', function (Blueprint $table) {
            $table->increments('id_penumpang');
            $table->string('username');
            $table->string('password');
            $table->string('nama_penumpang');
            $table->string('alamat_penumpang');
            $table->date('taggal_lahir');
            $table->string('jenis_kelamin');
            $table->integer('telepone')->unique(); 
            $table->string('token');        
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
        Schema::dropIfExists('penumpangs');
    }
}
