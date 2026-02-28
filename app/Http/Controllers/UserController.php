<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ProfileUpdateRequest;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService
    ) {}

    public function index(Request $request): View
    {
        $perPage = max(1, min(100, (int) $request->integer('per_page', 15)));

        return view('users.index', [
            'users' => $this->userService->paginateUsers($perPage),
        ]);
    }

    public function create(): View
    {
        return view('users.create', [
            'statuses' => $this->userService->statusOptions(),
        ]);
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->userService->createUser($request->validated());
        $password = $this->userService->defaultPassword();

        return redirect()
            ->route('users.index')
            ->with('status', 'تم إنشاء المستخدم بنجاح. كلمة المرور الافتراضية: '.$password);
    }

    public function show(User $user): View
    {
        return view('users.show', [
            'user' => $this->userService->getUserById((int) $user->id),
        ]);
    }

    public function edit(User $user): View
    {
        return view('users.update', [
            'user' => $this->userService->getUserById((int) $user->id),
            'statuses' => $this->userService->statusOptions(),
        ]);
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->userService->updateUser($user, $request->validated());

        return redirect()
            ->route('users.show', $user)
            ->with('status', 'تم تحديث بيانات المستخدم بنجاح.');
    }

    public function delete(User $user): View
    {
        return view('users.delete', [
            'user' => $this->userService->getUserById((int) $user->id),
        ]);
    }

    public function destroy(User $user): RedirectResponse
    {
        $this->userService->deleteUser($user);

        return redirect()
            ->route('users.index')
            ->with('status', 'تم حذف المستخدم بنجاح.');
    }

    public function profile(Request $request): View
    {
        return view('users.profile', [
            'user' => $request->user(),
        ]);
    }

    public function updateProfile(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $this->userService->updateProfile($user, $request->validated());

        return redirect()
            ->route('profile')
            ->with('status', 'تم تحديث الملف الشخصي بنجاح.');
    }

    public function resetPassword(User $user): RedirectResponse
    {
        $password = $this->userService->resetPassword($user);

        return redirect()
            ->route('users.show', $user)
            ->with('status', 'تم إعادة تعيين كلمة المرور بنجاح. كلمة المرور الافتراضية: '.$password);
    }
}
