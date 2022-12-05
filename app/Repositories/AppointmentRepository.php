<?php


namespace App\Repositories;


use App\Models\Appointment;
use App\Models\UserAppointment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class AppointmentRepository
{
    /**
     * @param array $data
     * @return Appointment
     */
    public function create(array $data): Appointment
    {
        return Appointment::create($data);
    }

    /**
     * @param Appointment $appointment
     * @param array $types
     */
    public function syncType(Appointment $appointment, array $types): void
    {
        $appointment->types()->sync($types);
    }

    /**
     * @return Builder
     */
    public function initList(): Builder
    {
        return Appointment::with('publishers', 'holders')->where('date', '>', Carbon::now());
    }

    /**
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function queryWherePublisher(Builder $query, int $userId): Builder
    {
        return $query->whereHas('publishers', function ($query) use ($userId) {
            $query->where('publisher_id', '=', $userId);
        });
    }

    /**
     * @param Builder $query
     * @param int $userId
     * @return Builder
     */
    public function queryWhereHolder(Builder $query, int $userId): Builder
    {
        $query->whereHas('holders', function ($query) use ($userId) {
            $query->where('holder_id', '=', $userId);
        });
    }

    /**
     * @param Builder $query
     * @param string $column
     * @param bool|int|string $value
     * @param string $operator
     * @return Builder
     */
    public function queryWhere(Builder $query, string $column, bool|string|int $value, string $operator = ""): Builder
    {
        return $query->where($column, $operator, $value);
    }

    /**
     * @param array|string $columns
     * @return Builder
     */
    public function initQuery(array|string $columns = '*'): Builder
    {
        return Appointment::select($columns);
    }

    /**
     * @param Builder $query
     * @return Collection
     */
    public function getFromQuery(Builder $query): Collection
    {
        return $query->get();
    }

    /**
     * @param Appointment $appointment
     * @param int $id
     */
    public function updateHolder(Appointment $appointment, int $id): void
    {
        UserAppointment::where('appointment_id', '=', $appointment->id)->update(['holder_id' => $id]);
    }

    /**
     * @param Appointment $appointment
     * @param int $id
     */
    public function removeHolder(Appointment $appointment, int $id): void
    {
        UserAppointment::where('appointment_id', '=', $appointment->id)->where(['holder_id' => $id])->delete();
    }

    /**
     * @param Appointment $appointment
     * @return array
     */
    public function getUserAppointment(Appointment $appointment): array
    {
        return UserAppointment::where('appointment_id', '=', $appointment->id)
            ->first()
            ->toArray();
    }

    /**
     * @param Appointment $appointment
     */
    public function delete(Appointment $appointment): void
    {
        $appointment->delete();
    }
}
