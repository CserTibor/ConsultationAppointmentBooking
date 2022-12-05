<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    private UserService $userService;
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(
        UserService $userService,
        UserRepository $userRepository,
        RoleRepository $roleRepository
    )
    {
        $this->userService = $userService;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
    }

    public function index()
    {
        return View::make('user-list', ['users' => $this->userService->getUserList()]);
    }

    public function create()
    {
        return View::make('registration-form');
    }

    public function store(RegistrationRequest $request)
    {
        $requestData = $request->only('name', 'email', 'contact', 'code', 'password');
        $this->userService->createUser($requestData);

        return redirect('/users/me');
    }

    public function me()
    {
        return View::make('user-profile', ['user' => auth()->user()]);
    }

    public function show(User $user)
    {
        return View::make('user-detail', ['user' => $user, 'roles' => $user->roles]);
    }

    public function edit(User $user)
    {
        return View::make('user-detail', ['user' => $user, 'roles' => $this->roleRepository->all()]);
    }

    public function addRole(RoleRequest $request, User $user)
    {
        $requestData = $request->only('roleId');
        $this->userRepository->assignRoles($user, $requestData['roleId']);

        return redirect('/users/' . $user->id);
    }
}
