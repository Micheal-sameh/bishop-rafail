<?php

namespace App\Services;

use App\DTOs\LectureDataDTO;
use App\Models\Lecture;
use App\Models\Subject;
use App\Repositories\LectureRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class LectureService
{
    public function __construct(
        private readonly LectureRepository $repository
    ) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->paginate($perPage);
    }

    public function allBySubject(int $subjectId): Collection
    {
        return $this->repository->allBySubject($subjectId);
    }

    public function create(LectureDataDTO $dto): Lecture
    {
        $data = $dto->toArray();
        $media = $data['media'] ?? null;
        unset($data['media']);

        $lecture = $this->repository->create($data);

        if ($media) {
            $lecture->addMedia($media)->toMediaCollection('lectures');
        }

        return $lecture->refresh()->load('subject');
    }

    public function findOrFail(int $id): Lecture
    {
        return $this->repository->findOrFail($id);
    }

    public function update(Lecture $lecture, LectureDataDTO $dto): Lecture
    {
        $data = $dto->toArray();
        $media = $data['media'] ?? null;
        unset($data['media']);

        if (! empty($data['url'])) {
            $lecture->clearMediaCollection('lectures');
        }

        if ($media) {
            $data['url'] = null;
        }

        $lecture = $this->repository->update($lecture, $data);

        if ($media) {
            $lecture->clearMediaCollection('lectures');
            $lecture->addMedia($media)->toMediaCollection('lectures');
        }

        return $lecture->refresh()->load('subject');
    }

    public function delete(Lecture $lecture): bool
    {
        $lecture->clearMediaCollection('lectures');

        return $this->repository->delete($lecture);
    }

    public function subjectOptions(): Collection
    {
        return Subject::query()->latest('id')->get(['id', 'title']);
    }
}
