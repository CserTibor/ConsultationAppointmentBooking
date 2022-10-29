<?php


namespace App\Services;


use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function getUserList()
    {
        $user = auth()->user();

        if ($user->isStudent()) {
            $users = User::whereHas('roles', function ($query) {
                $query->where('slug', '=', Role::TEACHER);
            })->get();
        } elseif ($user->isTeacher()) {
            $users = User::whereHas('roles', function ($query) {
                $query->where('slug', '=', Role::TEACHER);
            })->orWhereHas('publishedAppointments', function ($query) use ($user) {
                $query->where('publisher_id', '=', $user->id);
            })->get();
        } else {
            $users = User::all();
        }

        return $users;
    }

    public function createUser(array $requestData): void
    {

        if (User::where('email', '=', $requestData['email'])->exists()) {
            abort(422);
        }

        $user = User::create([
            'email' => $requestData['email'],
            'name' => $requestData['name'],
            'contact' => $requestData['contact'] ?? null,
            'code' => $requestData['code'],
            'password' => Hash::make($requestData['password']),
        ]);

        auth()->loginUsingId($user->id);
    }
}
