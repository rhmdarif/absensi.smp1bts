<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use Carbon\Carbon;
use App\Models\ServerCom;
use Illuminate\Http\Request;
use App\Models\MasterAttendType;
use App\Models\MasterTeacherAttend;
use App\Http\Controllers\Controller;
use App\Models\ServerComputerAttend;
use Illuminate\Support\Facades\Validator;

class AbsensiController extends Controller
{
    //
    public function index()
    {
        return view('admin.absensi.index', ['server_coms' => ServerCom::all()]);
    }

    public function loadData(Request $request) {
        $validator = Validator::make($request->all(), [
            'attend_type' => 'nullable|exists:master_attend_types,id',
            'period' => 'nullable|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        //Validation for week Input
        $weeks = explode('-', $request->period);
        $year = ($weeks[0]) ? $week[0] ?? date('Y') : date('Y');

        $week = $weeks[1] ?? date('W');
        $week_number = preg_replace('/[^0-9]/', '', $week);
        $day_of_week = $this->days_of_week($year, $week_number);

        $type = $request->attend_type ?? false;

        if($type) {
            $masterTeacherAttend = MasterTeacherAttend::where('created_at', '>=', reset($day_of_week))
                                                    ->where('created_at', '<=', end($day_of_week))
                                                    ->where('type_id', $type)
                                                    ->orderBy('id', 'desc')
                                                    ->limit(10)
                                                    ->with('type')
                                                    ->get();

        } else {
            $masterTeacherAttend = MasterTeacherAttend::where('created_at', '>=', reset($day_of_week))
                                                    ->where('created_at', '<=', end($day_of_week))
                                                    ->orderBy('id', 'desc')
                                                    ->limit(10)
                                                    ->with('type')
                                                    ->get();
        }

        if($masterTeacherAttend->count() == 0) {
            $msg = "Tidak ada data pada minggu ke-".$week_number." ditahun ".$year." ini";
        }

        return ['status' => true, 'msg' => ($msg ?? "oke"), "datas" => $masterTeacherAttend];
    }

    public function days_of_week($year, $week)
    {
        $carbon = Carbon::now();
        $carbon->setISODate($year,$week);
        return [$carbon->startOfWeek()->format("Y-m-d H:i:s"), $carbon->endOfWeek()->format("Y-m-d H:i:s")];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            't_start' => 'required|date_format:H:i',
            't_end' => 'required|date_format:H:i',
            'name' => 'required|string',
            'server_coms' => 'required'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        // return $request->all();
        if(strtotime($request->date." ".$request->t_start) < time()) {
            if(strtotime($request->date." ".$request->t_end) > time()) {
                $status = 1; // Sdg Berlangsung
            } else {
                 $status = 2; // Telah Selesai
            }
        } else {
            $status = 0; // Menunggu
        }

        $masterTeacherAttend = MasterTeacherAttend::create([
            'name' => $request->name,
            'waktu_mulai' => $request->t_start,
            'waktu_selesai' => $request->t_end,
            'tanggal' => $request->date,
            'status' => $status
        ]);

        // $server_coms = explode(',', $request->server_coms);
        // $select_server = "";
        foreach ($request->server_coms as $item) {
            ServerComputerAttend::create([
                'master_teacher_attend_id' => $masterTeacherAttend->id,
                'server_com_id' => $item
            ]);
        }

        return ['status' => true, 'msg' => "Absen telah ditambahkan"];
    }

    public function show($absensi)
    {
        return MasterTeacherAttend::where('id', $absensi)->with(['serverComputerAttends' => function($item) {
            return $item->select('master_teacher_attend_id', 'server_com_id');
        }])->first();
    }

    public function update(Request $request, MasterTeacherAttend $absensi)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required|date',
            't_start' => 'required|date_format:H:i',
            't_end' => 'required|date_format:H:i',
            'name' => 'required|string',
            'server_coms' => 'required',
            'status' => 'required|in:0,1,2',
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        ServerComputerAttend::where('master_teacher_attend_id', $absensi->id)->delete();
        foreach ($request->server_coms as $item) {
            ServerComputerAttend::create([
                'master_teacher_attend_id' => $absensi->id,
                'server_com_id' => $item
            ]);
        }

        $absensi->update([
            'name' => $request->name,
            'waktu_mulai' => $request->t_start,
            'waktu_selesai' => $request->t_end,
            'tanggal' => $request->date,
            'status' => $request->status,
        ]);

        return ['status' => true, 'msg' => "Absen telah diperbaharui"];
    }

    public function destroy(MasterTeacherAttend $absensi)
    {
        $absensi->delete();
        return ['status' => true, 'msg' => "Absen telah dihapus"];
    }
}
