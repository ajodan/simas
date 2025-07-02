<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonasiManualRequest extends FormRequest
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
            'nama_donatur' => 'required',
            'jenis_donasi' => 'required',
            'jumlah' => 'required',
            'tanggal' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama_donatur.required' => 'Kolom nominal harus di isi.',
            'jenis_donasi.required' => 'Kolom jenis donasi harus di isi.',
            'jumlah.required' => 'Kolom jumlah harus di isi.',
            'tanggal.required' => 'Kolom tanggal harus di isi.',
        ];
    }
}
