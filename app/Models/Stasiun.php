<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stasiun extends Model
{
    use HasFactory;
    protected $fillable = ['nama_stasiun', 'kota'];

    // Many-to-Many with Kereta
    public function keretas()
    {
        return $this->belongsToMany(Kereta::class, 'kereta_stasiun', 'stasiun_id', 'kereta_nomor')->withPivot('urutan_pemberhentian', 'jam_kedatangan', 'jam_keberangkatan');;
    }
}

