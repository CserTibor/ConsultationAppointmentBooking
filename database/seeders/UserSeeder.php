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
                'code' => 'ADMIN1'
            ]);

        $role = Role::where('slug', '=', 'admin')->first();
        $user->roles()->sync($role);

        foreach (range(0, 9) as $i)
            $user = User::firstOrCreate(
                [
                    'email' => 'teszt' . $i . '@teszt.com'
                ],
                [
                    'name' => 'Teszt' . $i,
                    'code' => 'TESZT' . $i,
                    'password' => Hash::make('teszt')
                ]);

        $studentRole = Role::where('slug', '=', 'student')->first();
        $user->roles()->sync($studentRole);

    }
}
