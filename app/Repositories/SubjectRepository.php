<?php

namespace App\Repositories;

use App\Models\Subject;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SubjectRepository
{
    public function __construct(protected Subject $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->select(['id', 'title', 'year', 'created_at'])
            ->with('media')
            ->latest('id')
            ->paginate($perPage);
    }

    public function allByYear(int $year): Collection
    {
        return $this->model->query()
            ->select(['id', 'title', 'year'])
            ->where('year', $year)
            ->latest('id')
            ->get();
    }

    public function create(array $data): Subject
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): Subject
    {
        return $this->model->query()
            ->select(['id', 'title', 'year', 'created_at', 'updated_at'])
            ->findOrFail($id);
    }

    public function update(Subject $subject, array $data): Subject
    {
        $subject->update($data);

        return $subject->refresh();
    }

    public function delete(Subject $subject): bool
    {
        return (bool) $subject->delete();
    }
}
