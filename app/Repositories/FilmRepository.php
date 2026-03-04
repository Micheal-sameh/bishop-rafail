<?php

namespace App\Repositories;

use App\Models\Film;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FilmRepository
{
    public function __construct(protected Film $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('creator:id,name')
            ->latest('id')
            ->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->model->query()->latest('id')->get();
    }

    public function create(array $data): Film
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): Film
    {
        return $this->model->query()
            ->with('creator:id,name')
            ->findOrFail($id);
    }

    public function update(Film $film, array $data): Film
    {
        $film->update($data);

        return $film->refresh();
    }

    public function delete(Film $film): bool
    {
        return (bool) $film->delete();
    }
}
