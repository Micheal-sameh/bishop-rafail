<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\SermonResource;
use App\Services\SermonService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SermonController extends BaseController
{
    public function __construct(
        private readonly SermonService $service
    ) {}

    public function index(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'playlist_id' => ['required', 'integer', 'exists:sermons_playlists,id'],
        ]);

        $items = $this->service->allByPlaylistId((int) $validated['playlist_id']);

        return $this->apiResponse(SermonResource::collection($items));
    }
}
