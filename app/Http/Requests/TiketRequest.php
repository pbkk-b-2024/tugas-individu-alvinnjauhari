<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TiketRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'penumpang_id' => 'required|exists:penumpangs,id',  // Tiket harus terkait dengan penumpang yang valid
            'kereta_id' => 'required|exists:keretas,id',  // Tiket harus terkait dengan kereta yang valid
            'jadwal_id' => 'required|exists:jadwals,id',  // Tiket harus terkait dengan jadwal yang valid
            'kursi_id' => 'required|exists:kursis,id',  // Kursi yang valid
            'stasiun_asal_id' => 'required|exists:stasiuns,id',  // Stasiun asal harus valid
            'stasiun_tujuan_id' => 'required|exists:stasiuns,id',  // Stasiun tujuan harus valid
            'harga' => 'required|numeric|min:0',  // Harga tiket harus angka dan tidak negatif
        ];
    }
}
