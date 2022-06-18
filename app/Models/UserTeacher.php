<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserTeacher extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['user_id', 'foto', 'kode_guru', 'nip', 'jenis_kelamin', 'alamat', 'nohp', 'pangkat',
    'golongan', 'jabatan', 'pekerjaan', 'password'];

    /**
     * Get the user that owns the UserTeacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the courses for the UserTeacher
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function courses(): HasMany
    {
        return $this->hasMany(TeacherCourse::class);
    }
}
