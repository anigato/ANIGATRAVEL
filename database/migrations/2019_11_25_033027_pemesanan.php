<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Pemesanan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->increments('id_pemesanan');
            $table->integer('kode_pemesanan');
            $table->date('tanggal_pemesanan');
            $table->string('tempat_pemesanan');
            $table->integer('id_pelanggan');
            $table->string('kode_kursi');
            $table->integer('id_rute');
            $table->string('tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_checkin');
            $table->time('jam_berangkat');
            $table->integer('total_bayar');
            $table->integer('id_petugas');
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
        Schema::dropIfExists('pemesanans');
    }
}
