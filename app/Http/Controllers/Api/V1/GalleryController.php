<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\GalleryResource;
use App\Services\GalleryService;
use Illuminate\Http\JsonResponse;

class GalleryController extends BaseController
{
    public function __construct(
        private readonly GalleryService $service
    ) {}

    public function index(): JsonResponse
    {
        return $this->apiResponse(GalleryResource::collection($this->service->all()));
    }
}
