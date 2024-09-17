<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JadwalRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'waktu_keberangkatan' => 'required|date',  // Format tanggal valid
            'waktu_kedatangan' => 'required|date|after:waktu_keberangkatan', // Kedatangan harus setelah keberangkatan
            'stasiun_asal_id' => 'required|exists:stasiuns,id',  // Stasiun asal harus valid
            'stasiun_tujuan_id' => 'required|exists:stasiuns,id',  // Stasiun tujuan harus valid

            'nomor_kereta' => 'required|exists:keretas,nomor',  // Harus sesuai dengan skema tabel keretas

        ];
    }
}
