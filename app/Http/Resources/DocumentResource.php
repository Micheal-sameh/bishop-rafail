<?php

namespace App\Http\Resources;

use App\Enums\BooksTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DocumentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url ?? $this->getFirstMediaUrl('documents'),
            'type' => new EnumResource($this->type, BooksTypes::class),
        ];
    }
}
