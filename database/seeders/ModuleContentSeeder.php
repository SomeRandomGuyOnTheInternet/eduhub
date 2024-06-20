<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ModuleContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $folderIds = DB::table('module_folders')->pluck('module_folder_id');

        foreach ($folderIds as $folderId) {
            for ($i = 0; $i < 3; $i++) { // Add 3 contents for each folder
                DB::table('module_contents')->insert([
                    'module_folder_id' => $folderId,
                    'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                    'description' => $faker->paragraph,
                    'file_path' => $faker->filePath(), // You can use a predefined path if necessary
                    'upload_date' => $faker->dateTimeThisYear(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
