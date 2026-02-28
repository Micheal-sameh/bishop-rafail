<?php

namespace App\Http\Requests\SermonPlaylist;

use App\Enums\SermonsTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSermonPlaylistRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'type' => ['required', 'integer', Rule::in(SermonsTypes::getValues())],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'العنوان مطلوب.',
            'type.required' => 'النوع مطلوب.',
            'type.in' => 'قيمة النوع غير صحيحة.',
        ];
    }
}
