<?php


namespace App\Repositories;


use App\Models\Type;
use Illuminate\Database\Eloquent\Collection;

class TypeRepository
{
    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return Type::all();
    }

}
