<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDonaturTetapRequest extends FormRequest
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
            'uuid_user' => 'required',
            'nominal' => 'required',
            'frekuensi' => 'required',
            'tanggal_mulai' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'uuid_user.required' => 'Kolom nama jammah harus di isi.',
            'nominal.required' => 'Kolom nominal harus di isi.',
            'frekuensi.required' => 'Kolom frekuensi harus di isi.',
            'tanggal_mulai.required' => 'Kolom tanggal mulai harus di isi.',
        ];
    }
}
