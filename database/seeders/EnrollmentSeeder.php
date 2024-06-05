<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Enrollment;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $enrollments = [
            ['student_id' => 1, 'module_id' => 3, 'enrollment_date' => '2024-06-03'],
            ['student_id' => 1, 'module_id' => 4, 'enrollment_date' => '2024-06-03'],
            ['student_id' => 2, 'module_id' => 1, 'enrollment_date' => '2024-06-04'],
            ['student_id' => 2, 'module_id' => 2, 'enrollment_date' => '2024-06-04'],
            ['student_id' => 3, 'module_id' => 3, 'enrollment_date' => '2024-06-04'],
            ['student_id' => 4, 'module_id' => 4, 'enrollment_date' => '2024-06-04'],
            ['student_id' => 5, 'module_id' => 5, 'enrollment_date' => '2024-06-05'],
            ['student_id' => 6, 'module_id' => 6, 'enrollment_date' => '2024-06-05'],
            ['student_id' => 4, 'module_id' => 7, 'enrollment_date' => '2024-06-05'],
            ['student_id' => 6, 'module_id' => 8, 'enrollment_date' => '2024-06-05'],
            ['student_id' => 6, 'module_id' => 9, 'enrollment_date' => '2024-06-06'],
            ['student_id' => 6, 'module_id' => 10, 'enrollment_date' => '2024-06-06'],
            ['student_id' => 1, 'module_id' => 2, 'enrollment_date' => '2024-06-06'],
            ['student_id' => 2, 'module_id' => 3, 'enrollment_date' => '2024-06-06'],
            ['student_id' => 3, 'module_id' => 4, 'enrollment_date' => '2024-06-07'],
            ['student_id' => 4, 'module_id' => 5, 'enrollment_date' => '2024-06-07'],
            ['student_id' => 5, 'module_id' => 6, 'enrollment_date' => '2024-06-07'],
            ['student_id' => 6, 'module_id' => 7, 'enrollment_date' => '2024-06-07'],
            ['student_id' => 6, 'module_id' => 8, 'enrollment_date' => '2024-06-08'],
            ['student_id' => 6, 'module_id' => 9, 'enrollment_date' => '2024-06-08'],
        ];

        foreach ($enrollments as $enrollment) {
            DB::table('enrollments')->insert($enrollment);
        }
    }
}
