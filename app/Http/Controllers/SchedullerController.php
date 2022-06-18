<?php

namespace App\Http\Controllers;

use App\Models\MasterTeacherAttend;
use Illuminate\Http\Request;

class SchedullerController extends Controller
{
    //
    public function task()
    {
        MasterTeacherAttend::where('tanggal', '>', date("Y-m-d"))
                            ->orWhere(function($query) {
                                return $query->where('tanggal', date("Y-m-d"))
                                    ->where('waktu_mulai', '>', date("H:i:s"));
                            })
                            ->update([
                                'status' => 0
                            ]);

        MasterTeacherAttend::where('tanggal', date("Y-m-d"))
                            ->where('waktu_mulai', '<=', date("H:i:s"))
                            ->where('waktu_selesai', '>=', date("H:i:s"))
                            ->update([
                                'status' => 1
                            ]);

        MasterTeacherAttend::where('tanggal', '<', date("Y-m-d"))
                            ->orWhere(function($query) {
                                return $query->where('tanggal', date("Y-m-d"))
                                    ->where('waktu_selesai', '<', date("H:i:s"));
                            })
                            ->update([
                                'status' => 2
                            ]);

        return 'success';
    }
}
