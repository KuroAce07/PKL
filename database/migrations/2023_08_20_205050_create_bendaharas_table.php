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
        Schema::create('bendaharas', function (Blueprint $table) {
            $table->id();
            $table->string('spp')->nullable();
            $table->integer('nilai_spp')->nullable();
            $table->string('sptjmspp')->nullable();
            $table->string('sp2d')->nullable();
            $table->integer('nilai_sp2d')->nullable();
            $table->string('verif_spp')->nullable();
            $table->string('spm')->nullable();
            $table->integer('nilai_spm')->nullable();
            $table->string('sptjmspm')->nullable();
            $table->string('lampiran_sumber_dana')->nullable();
            $table->string('no_spp')->nullable();
            $table->string('no_spm')->nullable();
            $table->string('no_sptjmspm')->nullable();
            $table->string('no_sptjmspp')->nullable();
            $table->string('no_sp2d')->nullable();
            $table->string('ket_spp')->nullable();
            $table->string('ket_spm')->nullable();
            $table->string('ket_sp2d')->nullable();
            $table->string('dpa_id');
            $table->date('tanggal')->nullable();
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
        Schema::dropIfExists('bendaharas');
    }
};
