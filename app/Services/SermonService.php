<?php

namespace App\Services;

use App\Models\Sermon;
use App\Models\SermonPlaylist;
use App\Repositories\SermonRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SermonService
{
    public function __construct(
        private readonly SermonRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function allByPlaylistId(int $playlistId): Collection
    {
        return $this->repository->allByPlaylistId($playlistId);
    }

    public function create(array $data): Sermon
    {
        $file = $data['file'] ?? null;
        unset($data['file']);

        $sermon = $this->repository->create($data);

        if ($file) {
            $sermon->addMedia($file)->toMediaCollection('sermons');
        }

        return $sermon->refresh()->load('playlist');
    }

    public function findOrFail(int $id): Sermon
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Sermon $sermon, array $data): Sermon
    {
        $file = $data['file'] ?? null;
        unset($data['file']);

        if (! empty($data['url'])) {
            $sermon->clearMediaCollection('sermons');
        }

        if ($file) {
            $data['url'] = null;
        }

        $sermon = $this->repository->update($sermon, $data);

        if ($file) {
            $sermon->clearMediaCollection('sermons');
            $sermon->addMedia($file)->toMediaCollection('sermons');
        }

        return $sermon->refresh()->load('playlist');
    }

    public function delete(Sermon $sermon): bool
    {
        $sermon->clearMediaCollection('sermons');

        return $this->repository->delete($sermon);
    }

    public function playlistOptions(): Collection
    {
        return SermonPlaylist::query()->latest('id')->get(['id', 'title']);
    }
}
