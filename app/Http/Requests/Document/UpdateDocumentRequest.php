<?php

namespace App\Http\Requests\Document;

use App\Enums\BooksTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class UpdateDocumentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'url' => ['nullable', 'url'],
            'file' => ['nullable', 'file', 'max:102400'],
            'type' => ['required', 'integer', Rule::in(BooksTypes::getValues())],
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
