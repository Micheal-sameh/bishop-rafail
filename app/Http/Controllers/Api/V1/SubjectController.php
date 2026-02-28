<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\SubjectIndexRequest;
use App\Http\Resources\SubjectResource;
use App\Services\SubjectService;
use Illuminate\Http\JsonResponse;

class SubjectController extends BaseController
{
    public function __construct(
        private readonly SubjectService $service
    ) {}

    public function index(SubjectIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return $this->apiResponse(SubjectResource::collection($this->service->allByYear((int) $validated['year'])));
    }
}
