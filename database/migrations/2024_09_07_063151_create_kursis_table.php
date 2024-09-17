<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKursisTable extends Migration
{
    public function up()
    {
        Schema::create('kursis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kursi');
            $table->string('nomor_kereta');
            $table->timestamps();

            $table->foreign('nomor_kereta')->references('nomor_kereta')->on('keretas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('kursis');
    }
}

