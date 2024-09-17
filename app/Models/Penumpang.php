<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penumpang extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak menggunakan nama plural default Laravel
    protected $table = 'penumpangs';

    // Tentukan kolom yang boleh diisi (mass assignable)
    protected $fillable = [
        'nik',
        'nama', 
        'email', 
        'no_telepon', 
    ];

    public function tiket()
    {
        return $this->hasMany(Tiket::class);
    }

    // Jika primary key bukan 'id' atau ada modifikasi lain
    protected $primaryKey = 'nik';

    // Tentukan apakah primary key auto-increment atau tidak
    public $incrementing = false;

    // Tentukan tipe data primary key jika bukan integer
    protected $keyType = 'string';
}
