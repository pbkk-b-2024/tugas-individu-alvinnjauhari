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
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kereta')->unique(); // Unique untuk one-to-one relationship
            $table->date('tanggal');
            $table->time('jam_berangkat');
            $table->time('jam_tiba');
            $table->timestamps();

            // Foreign key dari tabel kereta
            $table->foreign('nomor_kereta')->references('nomor')->on('keretas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jadwals');
    }
};
