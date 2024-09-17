<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTiketsTable extends Migration
{
    public function up()
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('penumpang_id');
            $table->string('nomor_kereta');
            $table->unsignedBigInteger('stasiun_keberangkatan');
            $table->unsignedBigInteger('stasiun_kedatangan');
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('kursi_id');
            $table->timestamps();

            $table->foreign('penumpang_id')->references('id')->on('penumpangs')->onDelete('cascade');
            $table->foreign('nomor_kereta')->references('nomor_kereta')->on('keretas')->onDelete('cascade');
            $table->foreign('stasiun_keberangkatan')->references('id')->on('stasiuns')->onDelete('cascade');
            $table->foreign('stasiun_kedatangan')->references('id')->on('stasiuns')->onDelete('cascade');
            $table->foreign('jadwal_id')->references('id')->on('jadwals')->onDelete('cascade');
            $table->foreign('kursi_id')->references('id')->on('kursis')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tikets');
    }
}

