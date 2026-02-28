<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\DocumentIndexRequest;
use App\Http\Resources\DocumentResource;
use App\Services\DocumentService;
use Illuminate\Http\JsonResponse;

class DocumentController extends BaseController
{
    public function __construct(
        private readonly DocumentService $service
    ) {}

    public function index(DocumentIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();
        $documents = $this->service->allByType((int) $validated['type']);

        return $this->apiResponse(DocumentResource::collection($documents));
    }
}
