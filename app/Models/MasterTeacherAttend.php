<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MasterTeacherAttend extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'waktu_mulai', 'waktu_selesai', 'total_hadir', 'total_terlambat', 'total_tdk_hadir','status', 'tanggal'];

    /**
     * Get the type that owns the MasterTeacherAttend
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(MasterAttendType::class);
    }

    /**
     * Get all of the comments for the MasterTeacherAttend
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function teacherAttends(): HasMany
    {
        return $this->hasMany(TeacherAttend::class, 'master_teacher_attend_id', 'id');
    }

    /**
     * Get all of the serverComputerAttends for the MasterTeacherAttend
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function serverComputerAttends(): HasMany
    {
        return $this->hasMany(ServerComputerAttend::class, 'master_teacher_attend_id', 'id');
    }
}
