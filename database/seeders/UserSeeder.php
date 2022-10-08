<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::firstOrCreate(
            [
                'email' => 'admin@admin.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin'),
            ]);

        $roles = Role::all();

        $user->roles()->sync($roles);
    }
}
