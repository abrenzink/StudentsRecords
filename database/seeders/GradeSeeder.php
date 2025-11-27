<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Course;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        $students = Student::all();
        $courses = Course::all();

        foreach ($students as $student) {
            foreach ($courses as $course) {
                Grade::create([
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'grade' => rand(60, 100) // nota aleatória entre 60 e 100
                ]);
            }
        }
    }
}
