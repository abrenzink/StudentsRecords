<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            ['name' => 'Mathematics', 'description' => 'Fundamentals of algebra, geometry, and calculus'],
            ['name' => 'English Literature', 'description' => 'Study of classic and modern English literature'],
            ['name' => 'Computer Science', 'description' => 'Introduction to programming and algorithms'],
        ];

        foreach ($courses as $c) {
            Course::create($c);
        }
    }
}
