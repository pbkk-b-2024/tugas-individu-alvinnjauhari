<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KursiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor_kereta' => 'required|exists:keretas,nomor',  // Harus sesuai dengan skema tabel keretas
            'nomor_kursi' => 'required|string|max:10|unique:kursis,nomor_kursi',  // Kursi harus unik per kereta
            'kelas_id' => 'required|exists:kelas,id',  // Kelas kursi harus valid
        ];
    }
}
