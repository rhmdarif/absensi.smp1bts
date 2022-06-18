<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Local extends Model
{
    use HasFactory;
    protected $fillable = [
        'major_id',
        'grade_id',
        'user_teacher_id',
        'nama',
    ];

    /**
     * Get the major that owns the Local
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function major(): BelongsTo
    {
        return $this->belongsTo(Major::class);
    }

    /**
     * Get the grade that owns the Local
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function grade(): BelongsTo
    {
        return $this->belongsTo(Grade::class);
    }

    /**
     * Get the user_teacher that owns the Local
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userTeacher(): BelongsTo
    {
        return $this->belongsTo(UserTeacher::class);
    }
}
