<?php

namespace App\Http\Resources;

use App\Enums\SermonsTypes;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SermonPlaylistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => new enumResource($this->type, SermonsTypes::class),
            'sermons_count' => $this->sermons_count,
        ];
    }
}
