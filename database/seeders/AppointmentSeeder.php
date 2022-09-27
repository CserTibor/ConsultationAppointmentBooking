<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Type;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $appointment = Appointment::firstOrCreate([
            'is_reserved' => false,
            'date' => Carbon::now(),
            'length' => 15
        ]);

        $types = Type::all();
        $appointment->types()->sync($types);

        $publisher = User::where('email', '=', 'admin@admin.com')->first();
        $appointment->publishers()->sync($publisher);
    }
}
