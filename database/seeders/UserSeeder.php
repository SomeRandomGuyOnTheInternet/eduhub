<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['first_name' => 'Muhammad', 'last_name' => 'Syahmi', 'email' => 'syahmi@gmail.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Cao', 'last_name' => 'Qi', 'email' => 'caoqi@gmail.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'John', 'last_name' => 'Binder', 'email' => 'binder@gmail.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Jane', 'last_name' => 'Doe', 'email' => 'jane.doe@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Alex', 'last_name' => 'Smith', 'email' => 'alex.smith@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Emily', 'last_name' => 'Brown', 'email' => 'emily.brown@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Michael', 'last_name' => 'Johnson', 'email' => 'michael.johnson@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Sarah', 'last_name' => 'Davis', 'email' => 'sarah.davis@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'David', 'last_name' => 'Miller', 'email' => 'david.miller@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Laura', 'last_name' => 'Wilson', 'email' => 'laura.wilson@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'James', 'last_name' => 'Taylor', 'email' => 'james.taylor@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Maria', 'last_name' => 'Anderson', 'email' => 'maria.anderson@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Robert', 'last_name' => 'Thomas', 'email' => 'robert.thomas@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Linda', 'last_name' => 'Jackson', 'email' => 'linda.jackson@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Charles', 'last_name' => 'White', 'email' => 'charles.white@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Susan', 'last_name' => 'Harris', 'email' => 'susan.harris@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Joseph', 'last_name' => 'Martin', 'email' => 'joseph.martin@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
            ['first_name' => 'Karen', 'last_name' => 'Thompson', 'email' => 'karen.thompson@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Thomas', 'last_name' => 'Garcia', 'email' => 'thomas.garcia@example.com', 'password' => Hash::make('password'), 'user_type' => 'student'],
            ['first_name' => 'Lisa', 'last_name' => 'Martinez', 'email' => 'lisa.martinez@example.com', 'password' => Hash::make('password'), 'user_type' => 'professor'],
        ];

        foreach ($users as $user) {
            DB::table('users')->insert($user);
        }
    }
}
