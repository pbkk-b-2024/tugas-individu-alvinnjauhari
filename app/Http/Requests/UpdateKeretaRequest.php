<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateKeretaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor' => [
                'required',
                'string',
                Rule::unique('keretas', 'nomor')->ignore($this->route('kereta')->id), // Abaikan validasi unik untuk kereta yang sedang diupdate
            ],
            'nama' => 'required|string|max:255', // Pastikan ini sesuai dengan nama kolom di tabel
            'jenis' => 'required|string|max:255',
            'kelas' => 'required|array',
            'kelas.*' => 'exists:kelas,id', // Validasi kelas
            'stasiuns' => 'required|array',
            'stasiuns.*' => 'exists:stasiuns,id', // Validasi stasiun
            'jam_kedatangan' => 'required|array',
            'jam_kedatangan.*' => 'date_format:H:i', // Validasi format jam kedatangan
            'jam_keberangkatan' => 'required|array',
            'jam_keberangkatan.*' => 'date_format:H:i', // Validasi format jam keberangkatan
        ];
    }
}
