<?php

namespace App\Models;

use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kereta extends Model
{
    use HasFactory;
    use Searchable;

    protected $table = 'keretas' ;
    

    protected $fillable = [
        'nomor',
        'nama',
        'jenis',
        'foto',
    ];

    protected $primaryKey = 'nomor';

    protected $keyType = 'string';

    public $incrementing = false;

    public function kelas(){
        return $this->belongsToMany(Kelas::class, 'kelas_kereta', 'kereta_nomor', 'kelas_id');
    }

    public function stasiuns()
    {
        return $this->belongsToMany(Stasiun::class, 'kereta_stasiun', 'kereta_nomor', 'stasiun_id')->withPivot('urutan_pemberhentian', 'jam_kedatangan', 'jam_keberangkatan');;
    }
}
