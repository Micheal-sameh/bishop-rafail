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
            ->select(['id', 'title', 'url', 'sermon_playlist_id', 'created_by', 'created_at'])
            ->with('creator:id,name')
            ->with('playlist:id,title,type')
            ->with('media')
            ->latest('id')
            ->paginate($perPage);
    }

    public function paginateByPlaylistType(int $type, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->select(['id', 'title', 'url', 'sermon_playlist_id', 'created_by', 'created_at'])
            ->with('creator:id,name')
            ->with('playlist:id,title,type')
            ->whereHas('playlist', function ($query) use ($type): void {
                $query->where('type', $type);
            })
            ->latest('id')
            ->paginate($perPage);
    }

    public function allByPlaylistId(int $playlistId): Collection
    {
        return $this->model->query()
            ->select(['id', 'title', 'url', 'sermon_playlist_id'])
            ->with('playlist:id,title,type')
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
        return $this->model->query()
            ->select(['id', 'title', 'url', 'sermon_playlist_id', 'created_by', 'created_at', 'updated_at'])
            ->with('creator:id,name')
            ->with('playlist:id,title,type')
            ->findOrFail($id);
    }

    public function update(Sermon $sermon, array $data): Sermon
    {
        $sermon->update($data);

        return $sermon->refresh()->load('playlist:id,title,type');
    }

    public function delete(Sermon $sermon): bool
    {
        return (bool) $sermon->delete();
    }
}
