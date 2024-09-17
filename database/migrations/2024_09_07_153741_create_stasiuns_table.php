<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStasiunsTable extends Migration
{
    public function up()
    {
        Schema::create('stasiuns', function (Blueprint $table) {
            $table->id();
            $table->string('nama_stasiun');
            $table->timestamps();
        });

        // Tabel Pivot Kereta dan Stasiun
        Schema::create('kereta_stasiun', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kereta');
            $table->unsignedBigInteger('stasiun_id');
            $table->timestamps();

            $table->foreign('nomor_kereta')->references('nomor_kereta')->on('keretas')->onDelete('cascade');
            $table->foreign('stasiun_id')->references('id')->on('stasiuns')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kereta_stasiun');
        Schema::dropIfExists('stasiuns');
    }
}

