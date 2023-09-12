<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToDpaTable extends Migration
{
    public function up()
    {
        Schema::table('dpa', function (Blueprint $table) {
            // Add description column for regular DPA description
            $table->text('description')->nullable();
            $table->text('descriptionPP')->nullable();
            $table->text('descriptionPPPTK')->nullable();

            $table->text('rup')->nullable();
            $table->text('nilairup')->nullable();
        });
    }

    public function down()
    {
        Schema::table('dpa', function (Blueprint $table) {
            // Remove description column
            $table->dropColumn('description');

            // Remove descriptionPP column
            $table->dropColumn('descriptionPP');

            // Remove descriptionPP column
            $table->dropColumn('descriptionPPPTK');

            $table->dropColumn('rup');
            $table->dropColumn('nilairup');
        });
    }
}