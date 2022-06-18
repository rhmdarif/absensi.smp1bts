<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LessonTime extends Model
{
    use HasFactory;
    protected $fillable = ['lesson_time_name_id', 'day_on_week_id', 'jam_masuk', 'jam_keluar'];

    public function getJamMasukHiAttribute()
    {
        return date('H:i', strtotime($this->jam_masuk));
    }
    public function getJamKeluarHiAttribute()
    {
        return date('H:i', strtotime($this->jam_keluar));
    }

    /**
     * Get the lessonTimeName that owns the LessonTime
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lessonTimeName(): BelongsTo
    {
        return $this->belongsTo(LessonTimeName::class);
    }

    /**
     * Get the dayOnWeek that owns the LessonTime
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function dayOnWeek(): BelongsTo
    {
        return $this->belongsTo(DayOnWeek::class);
    }
}
