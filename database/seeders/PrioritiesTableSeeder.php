<?php

namespace Database\Seeders;

use App\Models\TaskPriority;
use Illuminate\Database\Seeder;

class PrioritiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (is_null(TaskPriority::firstWhere('name', 'low'))) {
            TaskPriority::create([
                'id' => 1,
                'name' => 'low'
            ]);
        }

        if (is_null(TaskPriority::firstWhere('name', 'medium'))) {
            TaskPriority::create([
                'id' => 2,
                'name' => 'medium'
            ]);
        }

        if (is_null(TaskPriority::firstWhere('name', 'high'))) {
            TaskPriority::create([
                'id' => 3,
                'name' => 'high'
            ]);
        }
    }
}
