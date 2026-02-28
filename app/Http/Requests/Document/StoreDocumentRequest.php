<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url', 'required_without:file'],
            'file' => ['nullable', 'file', 'required_without:url', 'max:102400'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($this->filled('url') && $this->hasFile('file')) {
                $message = 'لا يمكن إدخال رابط مع ملف في نفس الوقت.';
                $validator->errors()->add('url', $message);
                $validator->errors()->add('file', $message);
            }
        });
    }
}
