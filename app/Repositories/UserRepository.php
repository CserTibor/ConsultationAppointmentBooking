<?php


namespace App\Repositories;


use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository
{

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return User::all();
    }

    /**
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        return User::create($data);
    }

    /**
     * @param User $user
     * @param array|Model|Collection $roles
     */
    public function assignRoles(User $user, Collection|Model|array $roles): void
    {
        $user->roles()->sync($roles);
    }

    /**
     * @param Builder $query
     * @param string $role
     * @return Builder
     */
    public function whereHasRole(Builder $query, string $role): Builder
    {
        return $query->whereHas('roles', function ($query) use ($role) {
            $query->where('slug', '=', $role);
        });
    }

    /**
     * @param Builder $query
     * @param int $id
     * @return Builder
     */
    public function orWhereHasPublishedAppointment(Builder $query, int $id): Builder
    {
        return $query->orWhereHas('publishedAppointments', function ($query) use ($id) {
            $query->where('publisher_id', '=', $id);
        });
    }

    /**
     * @param Builder $query
     * @return Collection
     */
    public function getFromQuery(Builder $query): Collection
    {
        return $query->get();
    }
}
