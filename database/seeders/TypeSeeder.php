<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'slug' => 'thesis_consultation',
                'name' => 'Szakdolgozati konzultáció'
            ],
            [
                'slug' => 'exam_review',
                'name' => 'Vizsga megtekintés'
            ],
            [
                'slug' => 'test_review',
                'name' => 'Zárthelyi megtekintés'
            ],
        ];

        foreach ($types as $type) {
            Type::firstOrCreate($type);
        }
    }
}
