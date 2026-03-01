<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\FilmResource;
use App\Services\FilmService;
use Illuminate\Http\JsonResponse;

class FilmController extends BaseController
{
    public function __construct(
        private readonly FilmService $service
    ) {}

    public function index(): JsonResponse
    {
        return $this->respondResource(FilmResource::collection($this->service->all()));
    }
}
