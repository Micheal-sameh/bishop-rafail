<?php

namespace App\Http\Requests\Sermon;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreSermonRequest extends FormRequest
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
            'url.required_without' => 'يرجى إدخال رابط أو رفع ملف.',
            'file.required_without' => 'يرجى رفع ملف أو إدخال رابط.',
            'sermon_playlist_id.required' => 'قائمة العظات مطلوبة.',
            'sermon_playlist_id.exists' => 'قائمة العظات غير موجودة.',
        ];
    }
}
