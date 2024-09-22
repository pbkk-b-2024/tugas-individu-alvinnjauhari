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
            $table->string('kota');
            $table->timestamps();
        });

        // Tabel Pivot Kereta dan Stasiun
        Schema::create('kereta_stasiun', function (Blueprint $table) {
            $table->id();
            $table->string('kereta_nomor'); // Pastikan tipe datanya sama dengan kolom 'nomor' di tabel 'keretas'       
            $table->unsignedBigInteger('stasiun_id');
            $table->integer('urutan_pemberhentian');
            $table->timestamp('jam_kedatangan')->nullable();
            $table->timestamp('jam_keberangkatan')->nullable();

            $table->foreign('kereta_nomor')->references('nomor')->on('keretas')->onDelete('cascade');
            $table->foreign('stasiun_id')->references('id')->on('stasiuns')->onDelete('cascade');
           
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('kereta_stasiun');
        Schema::dropIfExists('stasiuns');
    }
}

