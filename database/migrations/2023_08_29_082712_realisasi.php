<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class realisasi extends Migration
{
    public function up()
    {
        Schema::create('realisasi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('dpa_id')->nullable();
            $table->bigInteger('bulan_1')->nullable();
            $table->bigInteger('bulan_2')->nullable();
            $table->bigInteger('bulan_3')->nullable();
            $table->bigInteger('bulan_4')->nullable();
            $table->bigInteger('bulan_5')->nullable();
            $table->bigInteger('bulan_6')->nullable();
            $table->bigInteger('bulan_7')->nullable();
            $table->bigInteger('bulan_8')->nullable();
            $table->bigInteger('bulan_9')->nullable();
            $table->bigInteger('bulan_10')->nullable();
            $table->bigInteger('bulan_11')->nullable();
            $table->bigInteger('bulan_12')->nullable();
            $table->bigInteger('total_rak')->nullable();
            // ... add other columns as needed
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('realisasi');
    }
}

