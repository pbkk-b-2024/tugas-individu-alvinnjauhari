<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StasiunRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama_stasiun' => 'required|string|max:255|unique:stasiuns,nama_stasiun',  // Nama stasiun harus unik
            'kode_stasiun' => 'required|string|max:10|unique:stasiuns,kode_stasiun',  // Kode stasiun harus unik
            'kota' => 'required|string|max:255',
        ];
    }
}
