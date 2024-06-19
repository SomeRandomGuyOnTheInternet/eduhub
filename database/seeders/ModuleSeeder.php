<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Module;use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            ['module_name' => 'Database Systems', 'module_code' => 'INF2003', 'description' => 'This module aims to develop the software engineering and database administration skills required for designing, creating, running and developing a relational database application and its associated application software suite. In addition to enhancing the understanding of the fundamental concepts, theories and methods of the relational data model, physical file systems, optimization and indexing will also be covered in depth. In addition to the basic concepts in relational databases, this module will introduce time-series and spatially organized databases as IoT data is all about spatio-temporal relationships and join operations.', 'credits' => 6, 'logo' => null],
            ['module_name' => 'Management in Aviation', 'module_code' => 'AVI3001', 'description' => 'This module covers the essential management concepts and skills required in the aviation industry, focusing on areas such as airline operations, airport management, and aviation safety. It aims to provide a comprehensive understanding of the complexities involved in managing aviation businesses and organizations.', 'credits' => 4, 'logo' => null],
            ['module_name' => 'Software Engineering', 'module_code' => 'INF3004', 'description' => 'This module focuses on advanced software engineering concepts, methodologies, and practices. Students will learn about software development life cycle models, project management, software design patterns, and testing strategies. The module aims to equip students with the skills needed to design, develop, and maintain complex software systems.', 'credits' => 5, 'logo' => null],
            ['module_name' => 'Network Security', 'module_code' => 'SEC2001', 'description' => 'This module covers the principles and practices of network security, including the design and implementation of secure network architectures, intrusion detection systems, and encryption techniques. Students will gain practical experience in securing network infrastructure and protecting against cyber threats.', 'credits' => 5, 'logo' => null],
            ['module_name' => 'Artificial Intelligence', 'module_code' => 'AI3002', 'description' => 'This module provides an in-depth understanding of artificial intelligence concepts and techniques, including machine learning, neural networks, natural language processing, and robotics. Students will work on practical projects to apply AI algorithms and solve real-world problems.', 'credits' => 6, 'logo' => null],
            ['module_name' => 'Data Science', 'module_code' => 'DS3005', 'description' => 'This module focuses on the methodologies and tools used in data science for data collection, analysis, and visualization. Students will learn about statistical methods, data mining techniques, and the use of programming languages such as Python and R for data analysis.', 'credits' => 6, 'logo' => null],
            ['module_name' => 'Cloud Computing', 'module_code' => 'CC2002', 'description' => 'This module introduces the concepts and technologies behind cloud computing, including virtualization, cloud services, and distributed systems. Students will gain practical experience in deploying and managing cloud infrastructure using popular cloud platforms.', 'credits' => 4, 'logo' => null],
            ['module_name' => 'Human-Computer Interaction', 'module_code' => 'HCI2003', 'description' => 'This module explores the design and evaluation of user interfaces and interaction techniques. Students will learn about usability principles, user-centered design, and methods for evaluating the usability of interactive systems.', 'credits' => 3, 'logo' => null],
            ['module_name' => 'Big Data Analytics', 'module_code' => 'BDA3004', 'description' => 'This module covers the techniques and tools used for analyzing large datasets, including data warehousing, Hadoop, Spark, and NoSQL databases. Students will work on practical projects to apply big data analytics to solve complex problems.', 'credits' => 5, 'logo' => null],
            ['module_name' => 'Software Testing', 'module_code' => 'ST2001', 'description' => 'This module provides an overview of software testing methodologies, techniques, and tools. Students will learn about test planning, test case design, automated testing, and performance testing. Practical exercises will be used to reinforce theoretical concepts.', 'credits' => 3, 'logo' => null],
        ];

        foreach ($modules as $module) {
            DB::table('modules')->insert($module);
        }
    }
}
