<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultipleTables extends Migration
{
    public function up()
    {
        Schema::create('dokumen_kontraks', function (Blueprint $table) {
            $table->id();
            $table->integer('no_bukti');
            $table->string('nama_kegiatan_transaksi');
            $table->date('tanggal_kontrak');
            $table->integer('jumlah_uang');
            $table->integer('ppn')->nullable();
            $table->integer('pph')->nullable();
            $table->integer('potongan_lain')->nullable();
            $table->integer('jumlah_potongan')->nullable();
            $table->integer('jumlah_total');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();
        
            // Add the dpa_id column
            $table->unsignedBigInteger('dpa_id');
        
            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });        

        Schema::create('dokumen_pendukungs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->integer('approval')->default(0);
            $table->text('keterangan')->nullable();
            $table->text('upload_dokumen')->nullable();
            $table->text('alasan')->nullable();
            $table->timestamps();
        
            $table->unsignedBigInteger('dpa_id');
        
            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });
        

        Schema::create('e_purchasings', function (Blueprint $table) {
            $table->id();
            $table->string('e_commerce');
            $table->string('id_paket');
            $table->integer('jumlah');
            $table->integer('harga_total')->nullable();
            $table->date('tanggal_buat');
            $table->date('tanggal_ubah');
            $table->string('nama_pejabat_pengadaan');
            $table->string('nama_penyedia');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('dokumen_justifikasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('basts', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('baps', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('baphs', function (Blueprint $table) {
            $table->id();
            $table->string('nomor');
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('pilih_rekanans', function (Blueprint $table) {
            $table->id();
            $table->string('pilih')->nullable();
            $table->text('detail')->nullable();
            $table->string('jenis_pengadaan')->nullable();
            $table->text('keterangan')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('buktis', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('surats', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('dokumen_kontraks_spk', function (Blueprint $table) {
            $table->id();
            $table->integer('no_bukti');
            $table->string('nama_kegiatan_transaksi');
            $table->date('tanggal_kontrak');
            $table->integer('jumlah_uang');
            $table->integer('ppn')->nullable();
            $table->integer('pph')->nullable();
            $table->integer('potongan_lain')->nullable();
            $table->integer('jumlah_potongan')->nullable();
            $table->integer('jumlah_total');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();
        
            // Add the dpa_id column
            $table->unsignedBigInteger('dpa_id');
        
            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });  

        Schema::create('suratperjanjians', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('risalah_kontraks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_program_kegiatan');
            $table->string('nama_program');
            $table->string('nama_kegiatan');
            $table->string('nama_paket_pekerjaan');
            $table->string('lokasi_pekerjaan');
            $table->string('sumber_dana');
            $table->string('nama_pelaksana_pekerjaan');
            $table->string('jenis_usaha');
            $table->string('alamat_pelaksana_pekerjaan');
            $table->string('nama_pimpinan_direktur');
            $table->string('npwp');
            $table->string('nomor_kontrak');
            $table->date('tanggal_kontrak');
            $table->integer('nilai_kontrak');
            $table->string('nomor_rekening_bank');
            $table->string('nama_rekening');
            $table->string('metode_pengadaan');
            $table->string('adendum_kontrak');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('dpa_id');
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('npwps', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('bukus', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });

        Schema::create('nibs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nomor')->nullable();
            $table->date('tanggal');
            $table->text('keterangan')->nullable();
            $table->string('upload_dokumen')->nullable();
            $table->timestamps();
            $table->unsignedTinyInteger('approval')->default(0);
            $table->text('alasan')->nullable();
            $table->unsignedBigInteger('dpa_id');

            // Define the foreign key constraint
            $table->foreign('dpa_id')->references('id')->on('dpa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('pilih_rekanans');
        Schema::dropIfExists('dokumen_kontraks');
        Schema::dropIfExists('dokumen_pendukungs');
        Schema::dropIfExists('e_purchasings');
        Schema::dropIfExists('dokumen_justifikasi');
        Schema::dropIfExists('basts');
        Schema::dropIfExists('baps');
        Schema::dropIfExists('baphs');
        Schema::dropIfExists('risalah_kontraks');
        Schema::dropIfExists('npwps');
    }
}

