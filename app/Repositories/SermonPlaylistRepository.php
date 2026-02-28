<?php

namespace App\Repositories;

use App\Models\SermonPlaylist;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SermonPlaylistRepository
{
    public function __construct(protected SermonPlaylist $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->latest('id')
            ->paginate($perPage);
    }

    public function allByType(?int $type = null): Collection
    {
        $query = $this->model->query()->withCount('sermons')->latest('id');

        if (! is_null($type)) {
            $query->where('type', $type);
        }

        return $query->get();
    }

    public function create(array $data): SermonPlaylist
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): SermonPlaylist
    {
        return $this->model->query()->findOrFail($id);
    }

    public function update(SermonPlaylist $playlist, array $data): SermonPlaylist
    {
        $playlist->update($data);

        return $playlist->refresh();
    }

    public function delete(SermonPlaylist $playlist): bool
    {
        return (bool) $playlist->delete();
    }
}
