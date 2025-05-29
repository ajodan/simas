<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJadwalJumatRequest extends FormRequest
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
            'tanggal' => 'required',
            'tema_khutbah' => 'required',
            'nama_khatib' => 'required',
            'nama_imam' => 'required',
            'nama_muadzin' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tanggal.required' => 'Kolom tanggal harus di isi.',
            'tema_khutbah.required' => 'Kolom tema khutbah harus di isi.',
            'nama_khatib.required' => 'Kolom khatib harus di isi.',
            'nama_imam.required' => 'Kolom nama imam harus di isi.',
            'nama_muadzin.required' => 'Kolom nama muadzin harus di isi.',
        ];
    }
}
