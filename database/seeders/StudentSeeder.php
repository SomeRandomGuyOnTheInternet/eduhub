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
            ['user_id' => 6, 'date_of_birth' => '1996-07-11', 'faculty_id' => 1, 'gamepoints' => 0],
            ['user_id' => 7, 'date_of_birth' => '1997-08-19', 'faculty_id' => 2, 'gamepoints' => 0],
            ['user_id' => 5, 'date_of_birth' => '1998-09-27', 'faculty_id' => 3, 'gamepoints' => 0],
            ['user_id' => 8, 'date_of_birth' => '1999-10-05', 'faculty_id' => 4, 'gamepoints' => 0],
            ['user_id' => 9, 'date_of_birth' => '2000-11-15', 'faculty_id' => 5, 'gamepoints' => 0],
            ['user_id' => 10, 'date_of_birth' => '2001-12-25', 'faculty_id' => 6, 'gamepoints' => 0],
            ['user_id' => 11, 'date_of_birth' => '2002-01-15', 'faculty_id' => 7, 'gamepoints' => 0],
            ['user_id' => 12, 'date_of_birth' => '2003-02-28', 'faculty_id' => 8, 'gamepoints' => 0],
            ['user_id' => 13, 'date_of_birth' => '2004-03-30', 'faculty_id' => 9, 'gamepoints' => 0],
        ];

        foreach ($students as $student) {
            DB::table('students')->insert($student);
        }
    }
}
