<?php

namespace App\Http\Requests\Sermon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateSermonRequest extends FormRequest
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
            'sermon_playlist_id' => ['required', 'integer', 'exists:sermons_playlists,id'],
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

    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب.',
            'sermon_playlist_id.required' => 'قائمة العظات مطلوبة.',
            'sermon_playlist_id.exists' => 'قائمة العظات غير موجودة.',
        ];
    }
}
