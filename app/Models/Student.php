<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Student model.
 * Represents a student and their related grades and courses.
 */
class Student extends Model
{
    use HasFactory;

    /** @var array Allowed fields for mass assignment */
    protected $fillable = ['name', 'email', 'enrollment_date', 'student_code'];

    /**
     * Get all grades for this student.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Get all courses this student is enrolled in (via grades table).
     */
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'grades');
    }
}
