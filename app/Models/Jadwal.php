<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals';

    protected $fillable = ['tanggal', 'jam_berangkat', 'jam_tiba'];

    // Relasi one-to-one dengan model Kereta
}

