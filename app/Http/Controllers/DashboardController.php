<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * DashboardController
 *
 * Handles the main dashboard:
 * - Listing students and courses
 * - Adding new students
 * - Adding grades
 * - Showing reports per student and per course
 */
class DashboardController extends Controller
{
    /**
     * Show the dashboard with students, courses, grades, and reports.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // List all students
        $students = DB::select("SELECT * FROM students ORDER BY id");

        // List all courses
        $courses = DB::select("SELECT * FROM courses ORDER BY name");

        // Student reports (average and max grade per student)
        $reports = DB::select("
            SELECT s.id AS student_id, s.name,
                   AVG(g.grade) AS avg_grade,
                   MAX(g.grade) AS max_grade
            FROM students s
            LEFT JOIN grades g ON s.id = g.student_id
            GROUP BY s.id, s.name
        ");

        // Detailed grades with student and course info
        $grades = DB::select("
            SELECT g.id, s.id AS student_id, s.name AS student_name, s.student_code,
                   c.id AS course_id, c.name AS course_name, g.grade
            FROM grades g
            JOIN students s ON g.student_id = s.id
            JOIN courses c ON g.course_id = c.id
            ORDER BY s.id, c.name
        ");

        // Course reports (avg, max, min, total grades)
        $courseReports = DB::select("
            SELECT c.id AS course_id, c.name AS course_name,
                   AVG(g.grade) AS avg_grade,
                   MAX(g.grade) AS max_grade,
                   MIN(g.grade) AS min_grade,
                   COUNT(g.id) AS total_grades
            FROM courses c
            LEFT JOIN grades g ON c.id = g.course_id
            GROUP BY c.id, c.name
        ");

        return view('dashboard.index', compact('students', 'courses', 'reports', 'grades', 'courseReports'));
    }

    /**
     * Store a new student from the dashboard form.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeStudent(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:students,email',
            'enrollment_date' => 'required|date',
        ]);

        $student_code = strtoupper(substr(md5(uniqid()), 0, 6));

        DB::insert("
            INSERT INTO students (name, email, enrollment_date, student_code, created_at, updated_at)
            VALUES (?, ?, ?, ?, datetime('now'), datetime('now'))
        ", [$data['name'], $data['email'], $data['enrollment_date'], $student_code]);

        return redirect()->route('dashboard.index')->with('success', 'Student added successfully!');
    }

    /**
     * Store a new grade for a student from the dashboard form.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $studentId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function storeGrade(Request $request, $studentId)
    {
        $data = $request->validate([
            'course_id' => 'required|integer|exists:courses,id',
            'grade' => 'required|numeric|min:0|max:10',
        ]);

        DB::insert("
            INSERT INTO grades (student_id, course_id, grade, created_at, updated_at)
            VALUES (?, ?, ?, datetime('now'), datetime('now'))
        ", [$studentId, $data['course_id'], $data['grade']]);

        return redirect()->route('dashboard.index')->with('success', 'Grade added successfully!');
    }
}
