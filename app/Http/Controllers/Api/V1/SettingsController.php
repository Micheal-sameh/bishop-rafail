<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Repositories\SettingsRepository;
use Illuminate\Http\JsonResponse;

class SettingsController extends BaseController
{
    public function __construct(
        private readonly SettingsRepository $repository
    ) {}

    public function enums(): JsonResponse
    {
        $enums = $this->repository->enums();

        return $this->apiResponse($enums);
    }

    public function aboutUs(): JsonResponse
    {
        $aboutUs = $this->repository->aboutUsShow();

        return $this->apiResponse($aboutUs);
    }
}
