<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class TeachesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get professor user IDs and module IDs
        $professorIds = DB::table('users')->where('user_type', 'professor')->pluck('user_id');
        $moduleIds = DB::table('modules')->pluck('module_id');

        foreach ($professorIds as $professorId) {
            for ($i = 0; $i < 2; $i++) { // Assign each professor to 2 random modules
                DB::table('teaches')->insert([
                    'user_id' => $professorId,
                    'module_id' => $faker->randomElement($moduleIds),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
