<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJenisInventarisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jenis_inventaris' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'jenis_inventaris.required' => 'Kolom jenis inventaris harus di isi.',
        ];
    }
}
