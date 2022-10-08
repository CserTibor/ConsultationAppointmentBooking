<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'slug' => 'admin',
                'name' => 'Admin'
            ],
            [
                'slug' => 'teacher',
                'name' => 'Oktató'
            ],
            [
                'slug' => 'student',
                'name' => 'Hallgató'
            ],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }

    }
}
