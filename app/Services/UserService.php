<?php


namespace App\Services;


use App\Models\Role;
use App\Models\User;

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
}