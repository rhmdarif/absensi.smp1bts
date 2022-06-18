<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeacherAttend extends Model
{
    use HasFactory;

    protected $fillable = ['teacher_id', 'qr_code', 'master_teacher_attend_id', 'status', 'confirmed', 'is_manual', 'keterangan'];

    /**
     * Get the teacher that owns the TeacherAttend
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(UserTeacher::class, 'teacher_id', 'id');
    }

    /**
     * Get the masterTeacherAttend that owns the TeacherAttend
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function masterTeacherAttend(): BelongsTo
    {
        return $this->belongsTo(MasterTeacherAttend::class);
    }
}
