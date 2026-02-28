<?php

namespace App\Services;

use App\Enums\UserStatus;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private const DEFAULT_PASSWORD = '12345678';

    public function __construct(
        private readonly UserRepository $userRepository
    ) {}

    public function paginateUsers(int $perPage = 15): LengthAwarePaginator
    {
        return $this->userRepository->paginate($perPage);
    }

    public function getUserById(int $id): User
    {
        return $this->userRepository->findOrFail($id);
    }

    public function createUser(array $data): User
    {
        $data['password'] = Hash::make($this->defaultPassword());

        return $this->userRepository->create($data);
    }

    public function updateUser(User $user, array $data): User
    {
        return $this->userRepository->update($user, $data);
    }

    public function resetPassword(User $user): string
    {
        $password = $this->defaultPassword();

        $this->userRepository->update($user, [
            'password' => Hash::make($password),
        ]);

        return $password;
    }

    public function deleteUser(User $user): bool
    {
        return $this->userRepository->delete($user);
    }

    public function statusOptions(): array
    {
        return UserStatus::all();
    }

    public function defaultPassword(): string
    {
        return (string) config('app.default_user_password', self::DEFAULT_PASSWORD);
    }
}
