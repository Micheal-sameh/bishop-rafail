<?php

namespace App\Services;

use App\Models\Film;
use App\Repositories\FilmRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class FilmService
{
    public function __construct(
        private readonly FilmRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function all(): Collection
    {
        return $this->repository->all();
    }

    public function create(array $data): Film
    {
        return $this->repository->create($data);
    }

    public function findOrFail(int $id): Film
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Film $film, array $data): Film
    {
        return $this->repository->update($film, $data);
    }

    public function delete(Film $film): bool
    {
        return $this->repository->delete($film);
    }
}
