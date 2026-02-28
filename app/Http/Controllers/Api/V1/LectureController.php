<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Api\LectureIndexRequest;
use App\Http\Resources\LectureResource;
use App\Services\LectureService;
use Illuminate\Http\JsonResponse;

class LectureController extends BaseController
{
    public function __construct(
        private readonly LectureService $service
    ) {}

    public function index(LectureIndexRequest $request): JsonResponse
    {
        $validated = $request->validated();

        return $this->apiResponse(LectureResource::collection($this->service->allBySubject((int) $validated['subject_id'])));
    }
}
