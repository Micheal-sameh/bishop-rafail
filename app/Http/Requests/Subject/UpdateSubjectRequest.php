<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'year' => ['required', 'digits:4', 'integer', 'min:1900', 'max:2100'],
        ];
    }
}
