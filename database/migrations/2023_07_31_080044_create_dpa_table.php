<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDpaTable extends Migration
{
    public function up()
    {
        Schema::create('dpa', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_dpa')->nullable();
            $table->string('tahun')->nullable();
            $table->string('daerah')->nullable();
            $table->string('kode_urusan')->nullable();
            $table->string('nama_urusan')->nullable();
            $table->string('kode_bidang_urusan')->nullable();
            $table->string('nama_bidang_urusan')->nullable();
            $table->string('kode_skpd')->nullable();
            $table->string('nama_skpd')->nullable();
            $table->string('kode_sub_skpd')->nullable();
            $table->string('nama_sub_skpd')->nullable();
            $table->string('kode_program')->nullable();
            $table->string('nama_program')->nullable();
            $table->string('kode_kegiatan')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('nama_kegiatan')->nullable();
            $table->string('kode_sub_kegiatan')->nullable();
            $table->string('nama_sub_kegiatan')->nullable();
            $table->string('kode_akun')->nullable();
            $table->string('nama_akun')->nullable();
            $table->string('nilai_rincian')->nullable();
            $table->string('total_rak')->nullable();
            $table->string('bulan_1')->nullable();
            $table->string('bulan_2')->nullable();
            $table->string('bulan_3')->nullable();
            $table->string('bulan_4')->nullable();
            $table->string('bulan_5')->nullable();
            $table->string('bulan_6')->nullable();
            $table->string('bulan_7')->nullable();
            $table->string('bulan_8')->nullable();
            $table->string('bulan_9')->nullable();
            $table->string('bulan_10')->nullable();
            $table->string('bulan_11')->nullable();
            $table->string('bulan_12')->nullable();
            $table->string('tipe')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('user_id2')->nullable();
            $table->foreign('user_id2')->references('id')->on('users');
            $table->unsignedBigInteger('user_id3')->nullable();
            $table->foreign('user_id3')->references('id')->on('users');
            $table->unsignedBigInteger('user_id4')->nullable();
            $table->foreign('user_id4')->references('id')->on('users');
            $table->unsignedBigInteger('rekanan_id')->nullable();
            $table->foreign('rekanan_id')->references('id')->on('rekanans');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dpa');
    }
}
