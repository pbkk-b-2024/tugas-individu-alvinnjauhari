<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KeretaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;  // Pastikan user memiliki hak akses untuk melakukan request ini
    }

    public function rules(): array
    {
        return [
            'nomor_kereta' => 'required|string|unique:keretas,nomor_kereta|max:10', // Nomor kereta harus unik
            'nama_kereta' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',  // Harus sesuai dengan ID kelas yang ada
        ];
    }
}
