<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgendaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'deskripsi' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Kolom judul harus diisi.',
            'tanggal.required' => 'Kolom tanggal harus diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',
        ];
    }
}
