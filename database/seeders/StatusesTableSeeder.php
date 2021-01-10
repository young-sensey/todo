<?php

namespace Database\Seeders;

use App\Models\TaskStatus;
use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (is_null(TaskStatus::firstWhere('name', 'active'))) {
            TaskStatus::create([
                'id' => 1,
                'name' => 'active'
            ]);
        }

        if (is_null(TaskStatus::firstWhere('name', 'completed'))) {
            TaskStatus::create([
                'id' => 2,
                'name' => 'completed'
            ]);
        }
    }
}
