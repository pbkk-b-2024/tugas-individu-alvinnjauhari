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
    Schema::create('penumpangs', function (Blueprint $table) {
        $table->string('nik')->primary()->unique(); // Primary Key
        $table->string('nama');
        $table->string('email')->unique();
        $table->string('no_telepon');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('penumpangs');
}
};
