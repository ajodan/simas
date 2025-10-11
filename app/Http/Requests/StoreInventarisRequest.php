<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventarisRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'jenisinventaris_id' => 'required|exists:jenis_inventaris,id',
            'kode_inventaris' => 'required|string|max:255|unique:inventaris,kode_inventaris',
            'nama_inventaris' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'satuan' => 'required|string|max:50',
            'kondisi' => 'required|string|max:100',
            'keterangan' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tahun_perolehan' => 'nullable|integer|min:1900|max:' . date('Y'),
        ];
    }
}
