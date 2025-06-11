<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call the TasksTableSeeder
        $this->call(TasksTableSeeder::class);
    }
}
