<?php


namespace App\Services;

use App\Mail\AppointmentDeletedEmail;
use App\Models\Appointment;
use App\Models\User;
use App\Repositories\AppointmentRepository;
use App\Repositories\UserAppointmentRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;

class AppointmentService
{
    /**
     * @var AppointmentRepository
     */
    private AppointmentRepository $appointmentRepository;
    /**
     * @var UserAppointmentRepository
     */
    private UserAppointmentRepository $userAppointmentRepository;

    /**
     * AppointmentService constructor.
     * @param AppointmentRepository $appointmentRepository
     * @param UserAppointmentRepository $userAppointmentRepository
     */
    public function __construct(
        AppointmentRepository $appointmentRepository,
        UserAppointmentRepository $userAppointmentRepository
    )
    {
        $this->appointmentRepository = $appointmentRepository;
        $this->userAppointmentRepository = $userAppointmentRepository;
    }

    /**
     * @return Collection
     */
    public function list(): Collection
    {
        $user = auth()->user();
        $query = $this->appointmentRepository->initList();

        if ($user->isTeacher()) {
            $query = $this->appointmentRepository->queryWherePublisher($query, $user->id);
        } elseif ($user->isStudent()) {
            $query = $this->appointmentRepository->queryWhere($query, 'is_reserved', true);
        }

        return $this->appointmentRepository->getFromQuery($query);
    }

    /**
     * @param array $data
     */
    public function create(array $data): void
    {
        $user = auth()->user();
        $appointment = $this->appointmentRepository->create([
            'length' => $data['length'],
            'date' => Carbon::parse($data['date']),
            'is_reserved' => false,
        ]);

        $this->appointmentRepository->syncType($appointment, $data['types']);

        $this->userAppointmentRepository->create([
            'publisher_id' => $user->id,
            'appointment_id' => $appointment->id,
        ]);
    }

    public function delete(Appointment $appointment)
    {
        $pivot = $this->appointmentRepository->getUserAppointment($appointment);
        $user = User::findOrFail($pivot['holder_id']);
        new AppointmentDeletedEmail($user);

        $this->appointmentRepository->delete($appointment);
    }

    /**
     * @param Appointment $appointment
     */
    public function seize(Appointment $appointment): void
    {
        $appointment->update(['is_reserved' => true]);
        $this->appointmentRepository->updateHolder($appointment, auth()->id());
    }

    /**
     * @return Collection
     */
    public function myAppointments(): Collection
    {
        $user = auth()->user();

        $query = $this->appointmentRepository->initQuery();
        if ($user->isTeacher()) {
            $query = $this->appointmentRepository->queryWherePublisher($query, $user->id);
        } elseif ($user->isStudent()) {
            $query = $this->appointmentRepository->queryWhereHolder($query, $user->id);
        }

        return $this->appointmentRepository->getFromQuery($query);
    }

    /**
     * @param Appointment $appointment
     */
    public function resign(Appointment $appointment): void
    {
        $appointment->update(['is_reserved' => false]);
        $this->appointmentRepository->removeHolder($appointment, auth()->id());

        $pivot = $this->appointmentRepository->getUserAppointment($appointment);
        $user = User::findOrFail($pivot['publisher_id']);
        new AppointmentDeletedEmail($user);
    }
}
