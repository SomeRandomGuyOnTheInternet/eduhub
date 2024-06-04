<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faculties = [
            'Aerospace and Aviation',
            'Allied Health',
            'Building and Infrastructure Engineering',
            'Business and Management',
            'Chemical Engineering',
            'Design and Media',
            'Digital Supply Chain',
            'Electrical and Electronics Engineering',
            'Food Technology',
            'Information and Digital Technology',
            'Mechanical Engineering',
            'Nursing',
            'Pharmaceutical Engineering',
            'Systems Engineering',
            'Transport Engineering',
        ];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->insert([
                'faculty_name' => $faculty,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
