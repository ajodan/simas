<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArtikelRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kategori_id' => 'required|exists:kategori_artikels,id',
            'judul' => 'required|string|max:255',
            'slug' => 'nullable|string|unique:artikels,slug',
            'isi_artikel' => 'required|string',
            'status' => 'required|in:draft,published',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
}
