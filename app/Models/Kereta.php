<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'kereta' ;
    

    protected $fillable = [
        'nomor',
        'nama',
        'jenis',
        'kelas',
    ];

    protected $primaryKey = 'nomor';

    public function kelas(){
        return $this->belongsToMany(Kelas::class, 'kelas_kereta', 'kereta_nomor', 'kelas_id');
    }

    public function jadwals()
    {
        return $this->hasOne(Jadwal::class, 'kereta_nomor', 'nomor');
    }

    public function stasiuns()
    {
        return $this->belongsToMany(Stasiun::class, 'kereta_stasiun', 'nomor_kereta', 'stasiun_id');
    }
}
