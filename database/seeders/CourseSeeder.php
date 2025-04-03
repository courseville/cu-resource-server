<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            [
                'name' => 'Introduction to Computer Science',
                'description' => 'An introductory course to computer science concepts.',
                'code' => 'CSE101',
                'credits' => 3
            ],
            [
                'name' => 'Calculus I',
                'description' => 'A fundamental course in calculus.',
                'code' => 'MTH101',
                'credits' => 4
            ],
            [
                'name' => 'Database Management Systems',
                'description' => 'Learn how to design and manage relational databases.',
                'code' => 'CSE202',
                'credits' => 3
            ],
            [
                'name' => 'Data Structures and Algorithms',
                'description' => 'Study advanced data structures and algorithms.',
                'code' => 'CSE203',
                'credits' => 3
            ],
            [
                'name' => 'Digital Logic Design',
                'description' => 'Learn about the fundamentals of digital circuits and logic.',
                'code' => 'ECE101',
                'credits' => 3
            ]
        ];

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
