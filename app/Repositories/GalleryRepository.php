<?php

namespace App\Repositories;

use App\Models\Gallery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class GalleryRepository
{
    public function __construct(protected Gallery $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('creator:id,name')
            ->latest('id')
            ->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->model->query()->with('media')->latest('id')->get();
    }

    public function create(array $data = []): Gallery
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): Gallery
    {
        return $this->model->query()
            ->with('creator:id,name')
            ->findOrFail($id);
    }

    public function delete(Gallery $gallery): bool
    {
        return (bool) $gallery->delete();
    }
}
