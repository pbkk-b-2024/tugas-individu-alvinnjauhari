<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKeretaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor' => 'required|string|unique:keretas,nomor', // Nomor kereta harus unik
            'nama' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'kelas' => 'required|array',
            'kelas.*' => 'exists:kelas,id', // Validasi bahwa kelas yang dipilih harus ada di tabel kelas
            'stasiuns' => 'required|array',
            'stasiuns.*' => 'exists:stasiuns,id', // Validasi bahwa stasiun yang dipilih harus ada di tabel stasiun
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}

