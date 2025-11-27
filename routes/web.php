<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StudentController;


// Redirect the homepage to the dashboard
Route::get('/', function () {
    return redirect()->route('dashboard.index');
});

// Dashboard
// -----------------------------------------------------------------------------------------

//shows students, courses, grades and reports
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
// create a new student 
Route::post('/dashboard/students', [DashboardController::class, 'storeStudent'])->name('dashboard.students.store');
// add a grade to a specific student
Route::post('/dashboard/students/{student}/grades', [DashboardController::class, 'storeGrade'])->name('dashboard.grades.store');

// Students routes
// ---------------------------------------------------------------------------------------------
// List all students
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
// Create a new student
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
// Show edit form for a specific student
Route::get('/students/{id}/edit', [StudentController::class, 'edit'])->name('students.edit');
// Update student data
Route::put('/students/{id}', [StudentController::class, 'update'])->name('students.update');
// Delete a student
Route::delete('/students/{id}', [StudentController::class, 'destroy'])->name('students.destroy');



