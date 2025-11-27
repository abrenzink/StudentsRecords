<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // Listar alunos
    public function index()
    {
        $students = DB::select("SELECT * FROM students ORDER BY id");
        return view('students.index', compact('students'));
    }

    // Adicionar aluno
    public function store(Request $request)
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

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Formulário de edição
    public function edit($id)
    {
        $student = DB::select("SELECT * FROM students WHERE id = ?", [$id])[0];
        return view('students.edit', compact('student'));
    }

    // Atualizar aluno
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => "required|email|unique:students,email,{$id}",
            'enrollment_date' => 'required|date',
        ]);

        DB::update("
            UPDATE students
            SET name = ?, email = ?, enrollment_date = ?, updated_at = datetime('now')
            WHERE id = ?
        ", [$data['name'], $data['email'], $data['enrollment_date'], $id]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    // Remover aluno
    public function destroy($id)
    {
        DB::delete("DELETE FROM students WHERE id = ?", [$id]);
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
