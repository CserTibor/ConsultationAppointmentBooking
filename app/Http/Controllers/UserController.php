<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\RoleRequest;
use App\Models\Role;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{

    /**
     * @var UserService
     */
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return View::make('user-list', ['users' => $this->userService->getUserList()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        return View::make('registration-form');
    }

    /**
     * Store a newly created resource in storage.
     * @param RegistrationRequest $request
     * @return \Illuminate\Contracts\View\View
     */
    public function store(RegistrationRequest $request)
    {
        $requestData = $request->only('name', 'email', 'contact', 'code', 'password');
        $this->userService->createUser($requestData);

        return View::make('user-profile', ['user' => auth()->user()]);
    }

    /**
     * @return \Illuminate\Contracts\View\View
     */
    public function me()
    {
        return View::make('user-profile', ['user' => auth()->user()]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return View::make('user-detail', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return View::make('user-detail', ['user' => $user, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param RoleRequest $request
     * @param int $id
     */
    public function addRole(RoleRequest $request, int $id)
    {
        $user = User::findOrFail($id);

        $requestData = $request->only('roleId');
        $user->roles()->sync($requestData['roleId']);

        return redirect('/users/' . $id);
    }
}
