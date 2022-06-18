<?php

namespace App\Http\Controllers\QrServer;

use App\Models\QrCodeBase;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TeacherAttend;
use App\Http\Controllers\Controller;
use App\Models\MasterTeacherAttend;
use App\Models\ServerCom;
use App\Models\ServerComputerAttend;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use League\OAuth1\Client\Server\Server;

class ShowQrController extends Controller
{
    //
    public function index()
    {
        return view('qrserver.show');
    }

    public function reloadQr()
    {
        $generate = Str::random(15);
        $com_id = "COM-1_hAeWDzKrxO";

        QrCodeBase::updateOrCreate([
            'com_id' => $com_id
        ], [
            'code' => $generate
        ]);

        return ['status' => true, 'data' => $generate];
    }

    public function updatePicture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'photo' => 'nullable|string',
            'absen_id' => 'required|exists:master_teacher_attends,id',
            'teacher_id' => 'required|exists:user_teachers,id',
            'qr_code' => 'required|string',
            'fingerprint' => 'required|exists:server_coms'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $serverCom = ServerCom::where("fingerprint", $request->fingerprint)->first();
        $serverComputerAttend = ServerComputerAttend::where('server_com_id', $serverCom->id)->count();
        if(!$serverComputerAttend) {
            return ['status' => false, 'msg' => "Tidak dapat mengambil absensi pada komputer ini"];
        }

        $masterTeacherAttend = MasterTeacherAttend::find($request->absen_id);

        if($masterTeacherAttend == null) {
            return ['status' => false, 'msg' => "Tidak ada absen"];
        }

        $check_attend = TeacherAttend::where('master_teacher_attend_id', $request->absen_id)
                                    ->where('teacher_id', $request->teacher_id)
                                    ->count();

        if($check_attend > 0) {
            return ['status' => false, 'msg' => "Absen sudah diambil sebelumnya"];
        }

        $strTimeSelesaiAbsen = strtotime($masterTeacherAttend->tanggal." ".$masterTeacherAttend->waktu_selesai);

        // JIKA WAKTU PENGAMBILAN ABSEN TELAH SELESAI
        if( time() >= $strTimeSelesaiAbsen ) {
            $status = 2;

            $masterTeacherAttend->update([
                'total_terlambat' => $masterTeacherAttend->total_terlambat+1
            ]);
        } else {
            $status = 1;

            $masterTeacherAttend->update([
                'total_hadir' => $masterTeacherAttend->total_hadir+1
            ]);
        }

        $teacher_attend = TeacherAttend::create([
            'teacher_id' => $request->teacher_id,
            'qr_code' => $request->qr_code,
            'master_teacher_attend_id' => $request->absen_id,
            'status' => $status,
        ]);

        if(!empty($request->photo)) {
            $image_64 = $request->photo; //your base64 encoded data

            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1]; // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            // find substring fro replace here eg: data:image/png;base64,
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $userName_replace = preg_replace('/[^0-9A-Za-z]/', '', $teacher_attend->teacher->user->name);
            $imageName = date("YmdHis")."_".$userName_replace.'.'.$extension;

            Storage::disk('public')->put($imageName, base64_decode($image));
        }

        return ['status' => true, 'msg' => "Terimakasih telah login pak/ibu ".$teacher_attend->teacher->user->name];
    }

    public function checkServer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fingerprint' => 'required|string'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $serverCom = ServerCom::where('fingerprint', $request->fingerprint)->first();
        if($serverCom == null) {
            return ['status' => false, 'msg' => "Komputer Belum terdaftar, silahkan tambahkan sidik jari ".$request->fingerprint." pada Komputer Server dalam halaman admin."];
        }

        if($serverCom->is_active == false) {
            return ['status' => false, 'msg' => "Komputer tidak dapat digunakan sekarang."];
        }

        return ['status' => true, 'msg' => "Komputer Terdaftar"];
    }

    public function getAbsen()
    {
        $tgl = date('Y-m-d');
        $time = date('H:i:s');
        $absensi = MasterTeacherAttend::where('waktu_mulai', '<=', date('H:i:s'))->where('waktu_selesai', '>',
            date('H:i:s'))->where('tanggal', date('Y-m-d'))->orderBy('waktu_mulai', 'asc')->get();
        return $absensi;
    }
}
