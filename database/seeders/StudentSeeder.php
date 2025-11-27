<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use Illuminate\Support\Str;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        Student::truncate();

        $students = [
            ['name' => 'Emily Johnson', 'email' => 'emily.johnson@example.com', 'enrollment_date' => '2025-11-01'],
            ['name' => 'Michael Smith', 'email' => 'michael.smith@example.com', 'enrollment_date' => '2025-10-15'],
            ['name' => 'Jessica Brown', 'email' => 'jessica.brown@example.com', 'enrollment_date' => '2025-11-10'],
            ['name' => 'Daniel Wilson', 'email' => 'daniel.wilson@example.com', 'enrollment_date' => '2025-09-20'],
            ['name' => 'Olivia Davis', 'email' => 'olivia.davis@example.com', 'enrollment_date' => '2025-11-05'],
        ];

        foreach ($students as $s) {
            Student::create([
                'name' => $s['name'],
                'email' => $s['email'],
                'enrollment_date' => $s['enrollment_date'],
                'student_code' => Str::upper(Str::random(6)),
            ]);
        }
    }

}
