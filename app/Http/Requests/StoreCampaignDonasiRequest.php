<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCampaignDonasiRequest extends FormRequest
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
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required',
            'target_dana' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'judul.required' => 'Kolom judul harus di isi.',
            'deskripsi.required' => 'Kolom deskripsi harus di isi.',
            'gambar.required' => 'Kolom gambar harus di isi.',
            'target_dana.required' => 'Kolom target dana harus di isi.',
            'tanggal_mulai.required' => 'Kolom tanggal mulai harus di isi.',
            'tanggal_selesai.required' => 'Kolom tanggal selesai harus di isi.',
        ];
    }
}
