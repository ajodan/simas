<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanBarangRequest extends FormRequest
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
            'penanggung_jawab' => 'required',
            'barang' => 'required',
            'nomor' => 'required',
            'surat' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'penanggung_jawab.required' => 'Kolom penanggung jawab harus di isi.',
            'barang.required' => 'Kolom barang harus di isi.',
            'nomor.required' => 'Kolom nomor harus di isi.',
            'surat.required' => 'Kolom surat harus di isi.',
        ];
    }
}
