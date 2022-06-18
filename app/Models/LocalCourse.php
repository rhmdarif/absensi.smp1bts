<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LocalCourse extends Model
{
    use HasFactory;
    protected $fillable = ['local_id', 'course_id', 'lesson_time_id'];

    /**
     * Get the lessonTime that owns the LocalCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lessonTime(): BelongsTo
    {
        return $this->belongsTo(LessonTime::class);
    }

    /**
     * Get the course that owns the LocalCourse
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
