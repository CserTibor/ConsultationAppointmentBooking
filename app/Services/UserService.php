<?php


namespace App\Services;


use App\Models\Role;
use App\Models\User;
use App\Repositories\RoleRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    /**
     * @var RoleRepository
     */
    private RoleRepository $roleRepository;

    /**
     * UserService constructor.
     * @param UserRepository $userRepository
     * @param RoleRepository $roleRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * @return Collection
     */
    public function getUserList()
    {
        $user = auth()->user();

        $query = User::query();
        if ($user->isAdmin()) {
            $users = $this->userRepository->all();
        } elseif ($user->isStudent()) {
            $query = $this->userRepository->whereHasRole($query, Role::TEACHER);
            $users = $this->userRepository->getFromQuery($query);
        } elseif ($user->isTeacher()) {
            $query = $this->userRepository->whereHasRole($query, Role::TEACHER);
            $query = $this->userRepository->orWhereHasPublishedAppointment($query, $user->id);
            $users = $this->userRepository->getFromQuery($query);
        }

        return $users ?? collect();
    }

    /**
     * @param array $requestData
     */
    public function createUser(array $requestData): void
    {
        $user = $this->userRepository->create([
            'email' => $requestData['email'],
            'name' => $requestData['name'],
            'contact' => $requestData['contact'] ?? null,
            'code' => $requestData['code'],
            'password' => Hash::make($requestData['password']),
        ]);

        $studentRole = $this->roleRepository->findBySlug('student');
        $user->roles()->sync($studentRole);

        auth()->loginUsingId($user->id);
    }
}
