<?php


namespace App\Repositories;


use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Role::all();
    }

    /**
     * @param string $slug
     * @return Role|null
     */
    public function findBySlug(string $slug): Role|null
    {
        return Role::where('slug', '=', $slug)->first();
    }

}
