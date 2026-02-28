<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\SermonIndexRequest;
use App\Http\Resources\SermonResource;
use App\Services\SermonService;
use Illuminate\Http\JsonResponse;

class SermonController extends BaseController
{
    public function __construct(
        private readonly SermonService $service
    ) {}

    public function index(SermonIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $items = $this->service->allByPlaylistId((int) $validated['playlist_id']);

        return $this->apiResponse(SermonResource::collection($items));
    }
}
