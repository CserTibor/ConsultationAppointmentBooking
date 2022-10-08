<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Models\Role;
use App\Models\User;
use App\Models\UserAppointment;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        $user = User::first();
        auth()->loginUsingId($user->id);

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
     *
     * @param RegistrationRequest $request
     */
    public function store(RegistrationRequest $request)
    {
        $requestData = $request->only('name', 'email', 'mobileNumber', 'password');
        $this->userService->createUser($requestData);

        return redirect()->to('users/me');
    }

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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     */
    public function destroy($id)
    {
        //
    }
}
