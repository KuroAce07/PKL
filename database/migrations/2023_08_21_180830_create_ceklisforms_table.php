<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ceklisforms', function (Blueprint $table) {
            $table->id();
            $table->string('dpa_id');
            $table->string('nama');
            $table->boolean('kwitansi')->nullable();
            $table->boolean('nota_bukti_invoice')->nullable();
            $table->boolean('surat_pemesanan')->nullable();
            $table->boolean('dok_kontrak')->nullable();
            $table->boolean('surat_perjanjian')->nullable();
            $table->boolean('dok_epurchasing')->nullable();
            $table->boolean('ringkasan_kontrak')->nullable();
            $table->boolean('dok_pendukung')->nullable();
            $table->boolean('tkdn')->nullable();
            $table->boolean('berita_serah_terima')->nullable();
            $table->boolean('berita_pembayaran')->nullable();
            $table->boolean('berita_pemeriksaan')->nullable();
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
        Schema::dropIfExists('ceklisforms');
    }
};
