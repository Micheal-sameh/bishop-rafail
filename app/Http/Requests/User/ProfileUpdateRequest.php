<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $passwordRules = ['nullable', 'string', 'min:6', 'confirmed'];

        if ($this->user()?->must_change_password) {
            $passwordRules[0] = 'required';
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'password' => $passwordRules,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'password.confirmed' => 'تأكيد كلمة المرور غير مطابق.',
        ];
    }
}
