<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;
    protected $fillable = ['penumpang_id', 'nomor_kereta', 'stasiun_keberangkatan', 'stasiun_kedatangan', 'jadwal_id', 'kursi_id'];

    // Relasi ke Penumpang
    public function penumpang()
    {
        return $this->belongsTo(Penumpang::class);
    }

    // Relasi ke Kereta
    public function kereta()
    {
        return $this->belongsTo(Kereta::class, 'nomor_kereta', 'nomor_kereta');
    }

    // Relasi ke Stasiun
    public function stasiunKeberangkatan()
    {
        return $this->belongsTo(Stasiun::class, 'stasiun_keberangkatan');
    }

    public function stasiunKedatangan()
    {
        return $this->belongsTo(Stasiun::class, 'stasiun_kedatangan');
    }

    // Relasi ke Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    // Relasi ke Kursi
    public function kursi()
    {
        return $this->belongsTo(Kursi::class);
    }
}


