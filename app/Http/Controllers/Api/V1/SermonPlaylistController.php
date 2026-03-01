<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\SermonPlaylistIndexRequest;
use App\Http\Resources\SermonPlaylistResource;
use App\Services\SermonPlaylistService;
use Illuminate\Http\JsonResponse;

class SermonPlaylistController extends BaseController
{
    public function __construct(
        private readonly SermonPlaylistService $service
    ) {}

    public function index(SermonPlaylistIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $playlists = $this->service->allByType(isset($validated['type']) ? (int) $validated['type'] : null);

        return $this->respondResource(SermonPlaylistResource::collection($playlists));
    }
}
