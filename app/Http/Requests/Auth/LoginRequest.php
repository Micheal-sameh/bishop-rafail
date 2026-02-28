<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'login' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string'],
            'remember' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'login.required' => 'الرجاء إدخال البريد الإلكتروني أو رقم الهاتف.',
            'password.required' => 'الرجاء إدخال كلمة المرور.',
        ];
    }
}
