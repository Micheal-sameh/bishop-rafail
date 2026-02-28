<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LectureResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'url' => $this->url ?? $this->getFirstMediaUrl('lectures'),
            'subject_id' => $this->subject_id,
            'subject_title' => $this->subject?->title,
        ];
    }
}
