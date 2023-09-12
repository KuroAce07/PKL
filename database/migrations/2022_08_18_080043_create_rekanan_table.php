<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekananTable extends Migration
{
    public function up()
    {
        Schema::create('rekanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_rekanan');
            $table->enum('jenis_rekanan', ['Perorangan', 'Perusahaan']);
            $table->string('nik_rekanan')->nullable();
            $table->string('nomor_npwp')->nullable();
            $table->string('nama_rekanan');
            $table->string('nama_instansi')->nullable();
            $table->string('jenis_usaha')->nullable();
            $table->string('nama_bank')->nullable();
            $table->string('nama_cabang')->nullable();
            $table->string('nomor_rekening')->nullable();
            $table->string('nama_rekening')->nullable();
            $table->string('telepon')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rekanans');
    }
}

