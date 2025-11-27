<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Grade model.
 * Represents a grade assigned to a student in a specific course.
 */
class Grade extends Model
{
    use HasFactory;

    /** @var array Allowed fields for mass assignment */
    protected $fillable = ['student_id', 'course_id', 'grade'];

    /**
     * Get the student associated with this grade.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /**
     * Get the course associated with this grade.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
