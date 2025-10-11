<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJenisLaporanRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jenis_laporan' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jenis_laporan.required' => 'Kolom jenis laporan harus di isi.',
        ];
    }
}
