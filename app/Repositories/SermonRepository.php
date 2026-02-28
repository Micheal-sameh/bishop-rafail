<?php

namespace App\Repositories;

use App\Models\Sermon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SermonRepository
{
    public function __construct(protected Sermon $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('playlist')
            ->latest('id')
            ->paginate($perPage);
    }

    public function paginateByPlaylistType(int $type, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('playlist')
            ->whereHas('playlist', function ($query) use ($type): void {
                $query->where('type', $type);
            })
            ->latest('id')
            ->paginate($perPage);
    }

    public function allByPlaylistId(int $playlistId): Collection
    {
        return $this->model->query()
            ->with('playlist')
            ->where('sermon_playlist_id', $playlistId)
            ->latest('id')
            ->get();
    }

    public function create(array $data): Sermon
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): Sermon
    {
        return $this->model->query()->with('playlist')->findOrFail($id);
    }

    public function update(Sermon $sermon, array $data): Sermon
    {
        $sermon->update($data);

        return $sermon->refresh()->load('playlist');
    }

    public function delete(Sermon $sermon): bool
    {
        return (bool) $sermon->delete();
    }
}
