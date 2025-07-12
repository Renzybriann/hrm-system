<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Job; // Import the Job model

class JobSeeder extends Seeder
{
    public function run(): void
    {
        Job::create([
            'title' => 'Senior Laravel Developer',
            'description' => 'We are looking for an experienced Laravel developer to join our team.',
            'location' => 'Remote',
            'type' => 'Full-time'
        ]);

        Job::create([
            'title' => 'Frontend Vue.js Developer',
            'description' => 'Seeking a skilled Vue.js developer to build beautiful user interfaces.',
            'location' => 'New York, NY',
            'type' => 'Full-time'
        ]);

        Job::create([
            'title' => 'Marketing Intern',
            'description' => 'An exciting opportunity for a student or recent graduate.',
            'location' => 'San Francisco, CA',
            'type' => 'Part-time'
        ]);
    }
}