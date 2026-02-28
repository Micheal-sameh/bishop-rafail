<?php

namespace App\Http\Requests\Api;

use App\Enums\SermonsTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SermonPlaylistIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['nullable', 'integer', Rule::in(SermonsTypes::getValues())],
        ];
    }
}
