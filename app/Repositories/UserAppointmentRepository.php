<?php


namespace App\Repositories;


use App\Models\UserAppointment;

class UserAppointmentRepository
{
    /**
     * @param array $data
     * @return UserAppointment
     */
    public function create(array $data): UserAppointment
    {
        return UserAppointment::create($data);
    }
}
