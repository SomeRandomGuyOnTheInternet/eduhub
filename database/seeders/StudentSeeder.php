<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            ['user_id' => 6, 'faculty_id' => 1],
            ['user_id' => 5, 'faculty_id' => 3],
            ['user_id' => 8, 'faculty_id' => 4],
            ['user_id' => 9, 'faculty_id' => 5],
            ['user_id' => 10, 'faculty_id' => 6],
            ['user_id' => 11, 'faculty_id' => 7],
        ];

        foreach ($students as $student) {
            DB::table('students')->insert($student);
        }
    }
}
