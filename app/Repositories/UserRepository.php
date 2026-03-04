<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class UserRepository
{
    public function __construct(protected User $model) {}

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->query()
            ->with('creator:id,name')
            ->latest('id')
            ->paginate($perPage);
    }

    public function create(array $data): User
    {
        return $this->model->query()->create($data);
    }

    public function findOrFail(int $id): User
    {
        return $this->model->query()
            ->with('creator:id,name')
            ->findOrFail($id);
    }

    public function update(User $user, array $data): User
    {
        $user->update($data);

        return $user->refresh();
    }

    public function delete(User $user): bool
    {
        return (bool) $user->delete();
    }
}
