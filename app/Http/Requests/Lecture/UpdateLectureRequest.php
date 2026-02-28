<?php

namespace App\Http\Requests\Lecture;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateLectureRequest extends FormRequest
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
            'media' => ['nullable', 'file', 'mimetypes:video/mp4,video/webm,video/quicktime,audio/mpeg,audio/mp3,audio/wav,audio/ogg,audio/x-wav', 'max:102400'],
            'subject_id' => ['required', 'integer', 'exists:subjects,id'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            if ($this->filled('url') && $this->hasFile('media')) {
                $message = 'لا يمكن إدخال رابط ورفع ملف في نفس الوقت.';
                $validator->errors()->add('url', $message);
                $validator->errors()->add('media', $message);
            }
        });
    }
}
