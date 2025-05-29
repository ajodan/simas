<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRealisasiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tanggal_realisasi' => 'required',
            'kategori' => 'required',
            'jumlah' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tanggal_realisasi.required' => 'Kolom tanggal realisasi harus di isi.',
            'kategori.required' => 'Kolom kategori harus di isi.',
            'jumlah.required' => 'Kolom jumlah harus di isi.',
        ];
    }
}
