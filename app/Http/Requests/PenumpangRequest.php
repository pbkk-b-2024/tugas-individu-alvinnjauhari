<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PenumpangRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:penumpangs,email',  // Email opsional, tapi harus unik
            'nomor_telepon' => 'required|string|max:15',
            'jenis_kelamin' => 'required|in:pria,wanita',  // Harus salah satu dari pria atau wanita
        ];
    }
}
