<?php

namespace App\Http\Controllers\Api;

use App\Enums\SermonsTypes;
use App\Http\Resources\SermonPlaylistResource;
use App\Services\SermonPlaylistService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SermonPlaylistController extends BaseController
{
    public function __construct(
        private readonly SermonPlaylistService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'type' => ['nullable', 'integer', Rule::in(SermonsTypes::getValues())],
        ]);

        $playlists = $this->service->allByType(isset($validated['type']) ? (int) $validated['type'] : null);

        return $this->apiResponse(SermonPlaylistResource::collection($playlists));
    }
}
