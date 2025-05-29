<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreVisiMisiRequest extends FormRequest
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
            'kategori' => 'required',
            'item' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'kategori.required' => 'Kolom kategori harus di isi.',
            'item.required' => 'Kolom item harus di isi.',
        ];
    }
}
