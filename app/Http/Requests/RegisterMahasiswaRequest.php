<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterMahasiswaRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:150'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email', 'regex:/^[A-Za-z0-9._%+-]+@ui\.ac\.id$/'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()],
            'agree' => ['accepted'],
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.regex' => 'Gunakan email mahasiswa @ui.ac.id',
            'agree.accepted' => 'Anda harus menyetujui SOP & Tata Tertib.',
        ];
    }
}