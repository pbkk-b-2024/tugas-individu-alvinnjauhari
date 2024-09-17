<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kursi extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_kursi', 'nomor_kereta'];

    // Relasi ke Kereta
    public function kereta()
    {
        return $this->belongsTo(Kereta::class, 'nomor_kereta', 'nomor_kereta');
    }
}

