<?php

namespace App\Http\Requests\Api;

use App\Enums\BooksTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DocumentIndexRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'type' => ['required', 'integer', Rule::in(BooksTypes::getValues())],
        ];
    }
}
