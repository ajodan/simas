<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDonasiCampaignRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nominal_donasi' => 'required',
            'bukti_transfer' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'nominal_donasi.required' => 'Kolom nominal harus di isi.',
            'bukti_transfer.image' => 'Bukti transfer harus berupa gambar.',
            'bukti_transfer.mimes' => 'Bukti transfer harus berformat jpeg, png, jpg, atau gif.',
            'bukti_transfer.max' => 'Ukuran bukti transfer maksimal 2MB.',
        ];
    }
}
