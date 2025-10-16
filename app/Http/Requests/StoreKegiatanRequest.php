<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKegiatanRequest extends FormRequest
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
            'nama_kegiatan' => 'required',
            'tempat' => 'required',
            'tanggal' => 'required|date',
            'jam' => 'required|date_format:H:i',
            'banner' => 'required',
            'deskripsi' => 'required',
            'tema' => 'nullable|string',
            'jumlah_hadir' => 'nullable|integer',
            'jenis_kegiatan_id' => 'required|exists:jenis_kegiatans,id',
            'ustadz_id' => 'nullable|exists:ustadzs,id',
            'link_youtube' => 'nullable|string',
            'flag' => 'required|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'nama_kegiatan.required' => 'Kolom nama kegiatan harus di isi.',
            'tempat.required' => 'Kolom tempat harus di isi.',
            'tanggal.required' => 'Kolom tanggal harus di isi.',
            'tanggal.date' => 'Kolom tanggal harus berupa tanggal yang valid.',
            'jam.required' => 'Kolom jam harus di isi.',
            'jam.date_format' => 'Kolom jam harus berupa format jam yang valid (HH:MM).',
            'banner.required' => 'Kolom banner harus di isi.',
            'deskripsi.required' => 'Kolom deskripsi harus di isi.',
            'ustadz_id.exists' => 'Ustadz tidak valid.',
            'jenis_kegiatan_id.required' => 'Kolom jenis kegiatan harus di isi.',
            'jenis_kegiatan_id.exists' => 'Jenis kegiatan tidak valid.',
            'link_youtube.string' => 'Kolom link youtube harus berupa string.',
            'flag.required' => 'Kolom aktif harus di isi.',
            'flag.in' => 'Kolom aktif harus 0 atau 1.',
        ];
    }
}
