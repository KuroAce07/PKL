<?php
// database/migrations/2023_08_01_100000_create_arsip_lamas_table.php
// database/migrations/2023_08_01_100000_create_arsip_lamas_table.php

// database/migrations/2023_08_01_100000_create_arsip_lamas_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArsipLamasTable extends Migration
{
    public function up()
    {
        Schema::create('arsip_lamas', function (Blueprint $table) {
            $table->id();
            $table->string('no_spm')->nullable();
            $table->date('tanggal_spm')->nullable();
            $table->string('nilai_spm')->nullable(); // Changed to string
            $table->string('terbilang')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->string('uraian_belanja')->nullable();
            $table->string('sub_kegiatan')->nullable();
            $table->string('nama_sub_kegiatan')->nullable();
            $table->string('nama')->nullable();
            $table->string('pph_21')->nullable(); // Changed to string
            $table->string('pph_22')->nullable(); // Changed to string
            $table->string('pph_23')->nullable(); // Changed to string
            $table->string('ppn')->nullable(); // Changed to string
            $table->string('ppnd')->nullable(); // Changed to string
            $table->string('lain_lain')->nullable();
            $table->string('tanggal_sp2d')->nullable(); // Changed to string
            $table->string('no_sp2d')->nullable();
            $table->string('tipe')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('arsip_lamas');
    }
}




