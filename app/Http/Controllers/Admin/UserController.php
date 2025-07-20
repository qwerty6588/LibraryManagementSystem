<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Service\UserService;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Throwable;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index(): View
    {
        try {
            $users = $this->userService->getUsers();
            return view('admin.pages.users.index', compact('users'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function create(): View
    {
        try {
            return view('admin.pages.users.create');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function store(UserRequest $request): View|RedirectResponse
    {
        try {
            $this->userService->createUser($request->validated());
            return redirect()->route('admin.pages.users.index', [
                'users' => $this->userService->getUsers()
            ])->with('success', 'User created successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function edit(int $id): View|RedirectResponse
    {
        try {
            $user = $this->userService->findUserById($id);
            return view('admin.pages.users.edit', compact('user'));
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function update(UserRequest $request, int $id): View|RedirectResponse
    {
        try {
            $this->userService->updateUser($id, $request->validated());
            return redirect()->route('admin.pages.users.index', [
                'users' => $this->userService->getUsers()
            ])->with('success', 'User updated successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

    public function destroy(int $id): View|RedirectResponse
    {
        try {
            $this->userService->deleteUser($id);
            return redirect()->route('admin.pages.users.index', [
                'users' => $this->userService->getUsers()
            ])->with('success', 'User deleted successfully');
        } catch (Throwable $th) {
            return $this->viewException($th);
        }
    }

}
