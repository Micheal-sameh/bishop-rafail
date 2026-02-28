<?php

namespace App\Services;

use App\Models\Gallery;
use App\Repositories\GalleryRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class GalleryService
{
    public function __construct(
        private readonly GalleryRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Gallery
    {
        $image = $data['image'];

        $gallery = $this->repository->create();
        $gallery->addMedia($image)->toMediaCollection('gallery');

        return $gallery->refresh();
    }

    public function createMany(array $images): void
    {
        foreach ($images as $image) {
            if (! $image instanceof UploadedFile) {
                continue;
            }

            $this->create([
                'image' => $image,
            ]);
        }
    }

    public function findOrFail(int $id): Gallery
    {
        return $this->repository->findOrFail($id);
    }

    public function delete(Gallery $gallery): bool
    {
        $gallery->clearMediaCollection('gallery');

        return $this->repository->delete($gallery);
    }
}
