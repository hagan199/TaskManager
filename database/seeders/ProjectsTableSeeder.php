<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Define your project data
        $projects = [
            [
                'name' => 'Project 1',
            ],
            [
                'name' => 'Project 2',
            ],
            // Add more projects as needed
        ];

        // Insert the data into the projects table
        DB::table('projects')->insert($projects);
    }
}
