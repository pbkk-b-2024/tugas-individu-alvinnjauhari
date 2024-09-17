<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas' ;

    protected $fillable = [
        'nama',
    ];

    public function keretas(){
        return $this->belongsToMany(Kelas::class, 'kelas_kereta', 'kelas_id', 'kereta_nomor');
    }
}
