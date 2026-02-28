<?php

namespace App\Services;

use App\Models\Subject;
use App\Repositories\SubjectRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SubjectService
{
    public function __construct(
        private readonly SubjectRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function allByYear(int $year): Collection
    {
        return $this->repository->allByYear($year);
    }

    public function create(array $data): Subject
    {
        return $this->repository->create($data);
    }

    public function findOrFail(int $id): Subject
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Subject $subject, array $data): Subject
    {
        return $this->repository->update($subject, $data);
    }

    public function delete(Subject $subject): bool
    {
        return $this->repository->delete($subject);
    }
}
