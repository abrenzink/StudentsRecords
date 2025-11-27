<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Course model.
 * Represents a course and its related students and grades.
 */
class Course extends Model
{
    use HasFactory;

    /** @var array Fields allowed for mass assignment */
    protected $fillable = ['name', 'description'];

    /**
     * Get all grades for this course.
     */
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    /**
     * Get all students enrolled in this course (via grades table).
     */
    public function students()
    {
        return $this->belongsToMany(Student::class, 'grades');
    }
}
