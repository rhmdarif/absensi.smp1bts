<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherCourse extends Model
{
    use HasFactory;
    protected $fillable = ['course_id', 'user_teacher_id', 'local_id'];

    /**
     * Get the course that owns the TeacherCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the userTeacher that owns the TeacherCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userTeacher(): BelongsTo
    {
        return $this->belongsTo(UserTeacher::class);
    }

    /**
     * Get the local that owns the TeacherCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function local(): BelongsTo
    {
        return $this->belongsTo(Local::class);
    }
}
