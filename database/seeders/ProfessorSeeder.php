<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Professor;use Illuminate\Support\Facades\DB;

class ProfessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professors = [
            ['user_id' => 4, 'faculty_id' => 10],
            ['user_id' => 5, 'faculty_id' => 1],
            ['user_id' => 8, 'faculty_id' => 3],
            ['user_id' => 9, 'faculty_id' => 2],
            ['user_id' => 10, 'faculty_id' => 5],
            ['user_id' => 11, 'faculty_id' => 4],
            ['user_id' => 12, 'faculty_id' => 7],
            ['user_id' => 13, 'faculty_id' => 6],
        ];

        foreach ($professors as $professor) {
            DB::table('professors')->insert($professor);
        }
    }
}
