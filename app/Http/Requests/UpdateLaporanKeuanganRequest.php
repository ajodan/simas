<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLaporanKeuanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        return [
            'jenis_laporan_id' => 'required|exists:jenis_laporans,id',
            'saldo_akhir' => 'required|numeric',
            'upload_file' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'jenis_laporan_id.required' => 'Kolom jenis laporan harus di isi.',
            'jenis_laporan_id.exists' => 'Jenis laporan yang dipilih tidak valid.',
            'saldo_akhir.required' => 'Kolom saldo akhir harus di isi.',
            'saldo_akhir.numeric' => 'Kolom saldo akhir harus berupa angka.',
            'upload_file.file' => 'File harus berupa file.',
            'upload_file.mimes' => 'Format file harus pdf, doc, docx, xls, atau xlsx.',
            'upload_file.max' => 'Ukuran file maksimal 2MB.',
        ];
    }
}
