<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('keretas', function (Blueprint $table) {
        $table->string('nomor')->primary()->unique(); // Menambahkan unique pada nomor_kereta
        $table->string('nama');
        $table->string('jenis');
        $table->timestamps();
    });

    Schema::create('kelas', function (Blueprint $table){
        $table->id();
        $table->string('nama');
        $table->timestamps();
    });

    Schema::create('kelas_kereta', function (Blueprint $table){
        $table->id();
        $table->string('kereta_nomor');
        $table->foreign('kereta_nomor')->references('nomor')->on('keretas')->onDelete('cascade');        
        $table->foreignId('kelas_id')->constrained('kelas')->onDelete('cascade');
        $table->timestamps();
    });
    
}

public function down()
{
    Schema::dropIfExists('kereta');
    Schema::dropIfExists('kelas');
    Schema::dropIfExists('kelas_kereta');
}

};
