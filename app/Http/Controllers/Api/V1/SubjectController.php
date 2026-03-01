<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\SubjectFilterDTO;
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
        $dto = SubjectFilterDTO::fromArray($request->validated());

        return $this->respondResource(SubjectResource::collection($this->service->allByYear((int) $dto->year)));
    }
}
