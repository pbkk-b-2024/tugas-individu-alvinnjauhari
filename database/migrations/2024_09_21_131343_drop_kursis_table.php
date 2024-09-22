<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropKursisTable extends Migration
{
    public function up()
    {
        Schema::table('tikets', function (Blueprint $table) {
            $table->dropForeign(['nomor_kereta']); // Hapus kunci asing
        });
        Schema::table('tikets', function (Blueprint $table) {
            $table->dropForeign(['penumpang_id']); // Hapus kunci asing ke tabel penumpangs
        });
        Schema::dropIfExists('kursis');
    }

    public function down()
    {
        // Jika Anda ingin mengembalikan tabel kursi, Anda bisa mendefinisikan strukturnya di sini.
        Schema::create('kursis', function (Blueprint $table) {
            $table->id();
            $table->string('nomor'); // Sesuaikan dengan kolom yang Anda butuhkan
            $table->foreignId('kereta_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }
}

