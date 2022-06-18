<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'type'];

    /**
     * Get all of the localCourses for the Course
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function localCourses(): HasMany
    {
        return $this->hasMany(LocalCourse::class, 'course_id', 'id');
    }
}
