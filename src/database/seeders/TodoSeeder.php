<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('todos')->insert([
            [
                'task' => 'Buy Car',
                'completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Go to see the doctor',
                'completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'task' => 'Watch movie',
                'completed' => false,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
