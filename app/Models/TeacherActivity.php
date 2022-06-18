<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherActivity extends Model
{
    use HasFactory;
    protected $fillable = ['teacher_id', 'title', 'description', 'period', 'start_at', 'end_at'];
}
