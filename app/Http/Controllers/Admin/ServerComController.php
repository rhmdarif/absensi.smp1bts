<?php

namespace App\Http\Controllers\Admin;

use App\Models\ServerCom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class ServerComController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.server.index');
    }

    public function loadData()
    {
        return datatables()->of(ServerCom::query())->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' => 'required|string',
            'fingerprint' => 'required|unique:server_coms,fingerprint',
            'status' => 'required|in:1,2'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        ServerCom::create([
            'name' => $request->name,
            'location' => $request->location,
            'fingerprint' => $request->fingerprint,
            'is_active' => ($request->status == 2)? false : true,
        ]);

        return ['status' => true, 'msg' => 'Komputer '.$request->name.' telah ditambahkan'];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServerCom  $serverCom
     * @return \Illuminate\Http\Response
     */
    public function show(ServerCom $serverCom)
    {
        //
        return $serverCom;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServerCom  $serverCom
     * @return \Illuminate\Http\Response
     */
    public function edit(ServerCom $serverCom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServerCom  $serverCom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServerCom $serverCom)
    {
        //
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'location' => 'required|string',
            'fingerprint' => 'required|unique:server_coms,fingerprint,'.$serverCom->id,
            'status' => 'required|in:1,2'
        ]);

        if($validator->fails()) {
            return ['status' => false, 'msg' => $validator->errors()->first()];
        }

        $serverCom->update([
            'name' => $request->name,
            'location' => $request->location,
            'fingerprint' => $request->fingerprint,
            'is_active' => ($request->status == 2)? false : true,
        ]);

        return ['status' => true, 'msg' => 'Komputer '.$request->name.' telah diperbaharui'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServerCom  $serverCom
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServerCom $serverCom)
    {
        //
        $serverCom->delete();
        return ['status' => true, 'msg' => "Komputer telah dihapus"];
    }
}
