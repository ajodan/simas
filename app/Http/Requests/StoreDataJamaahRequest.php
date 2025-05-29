<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDataJamaahRequest extends FormRequest
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
            'nama' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nama.required' => 'Kolom nama harus di isi.',
            'email.required' => 'Kolom email harus di isi.',
            'jenis_kelamin.required' => 'Kolom jenis_kelamin harus di isi.',
            'alamat.required' => 'Kolom alamat harus di isi.',
            'no_hp.required' => 'Kolom no hp harus di isi.',
            'status.required' => 'Kolom status harus di isi.',
        ];
    }
}
