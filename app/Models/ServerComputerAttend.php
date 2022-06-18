<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerComputerAttend extends Model
{
    use HasFactory;
    protected $fillable = ['master_teacher_attend_id', 'server_com_id'];
}
