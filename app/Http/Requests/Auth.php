<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Auth extends FormRequest
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
            'username' => 'required|email',
            'password' => 'required',
            'captcha_answer' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Kolom username harus di isi',
            'username.email' => 'Kolom username harus berupa alamat email yang valid',
            'password.required' => 'Kolom password harus di isi',
            'captcha_answer.required' => 'Captcha harus diisi',
            'captcha_answer.numeric' => 'Captcha harus berupa angka'
        ];
    }

    public function getCredentials()
    {
        $username = $this->get('username');

        if ($username) {
            return [
                'username' => $username,
                'password' => $this->get('password')
            ];
        }

        return $this->only('username', 'password');
    }
}
