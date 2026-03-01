<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\LectureFilterDTO;
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
        $dto = LectureFilterDTO::fromArray($request->validated());

        return $this->respondResource(LectureResource::collection($this->service->allBySubject((int) $dto->subject_id)));
    }
}
