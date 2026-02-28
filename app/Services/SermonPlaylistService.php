<?php

namespace App\Services;

use App\Enums\SermonsTypes;
use App\Models\SermonPlaylist;
use App\Repositories\SermonPlaylistRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SermonPlaylistService
{
    public function __construct(
        private readonly SermonPlaylistRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function allByType(?int $type = null): Collection
    {
        return $this->repository->allByType($type);
    }

    public function create(array $data): SermonPlaylist
    {
        return $this->repository->create($data);
    }

    public function findOrFail(int $id): SermonPlaylist
    {
        return $this->repository->findOrFail($id);
    }

    public function update(SermonPlaylist $playlist, array $data): SermonPlaylist
    {
        return $this->repository->update($playlist, $data);
    }

    public function delete(SermonPlaylist $playlist): bool
    {
        return $this->repository->delete($playlist);
    }

    public function typeOptions(): array
    {
        return SermonsTypes::all();
    }
}
