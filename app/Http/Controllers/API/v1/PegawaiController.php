<?php

namespace App\Http\Controllers\API\v1;

use App\Models\pegawai;
use Illuminate\Http\Request;
use App\Models\level;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = pegawai::select('id_pegawai', 'nama_pegawai', 'nip', 'alamat')->get();
        return $result;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
        ]);
        $post = pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'nip' => $request->nip,
            'alamat' => $request->alamat,
        ]);

        if ($post) {
            return response()->json([
                'status' => 'Success',
            ]);
        }
        abort(400);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pegawai $pegawai_id)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
        ]);
        $model = $pegawai_id;
        $model->nama_pegawai = $request->nama_pegawai;
        $model->nip = $request->nip;
        $model->alamat = $request->alamat;

        if ($model->save()) {
            return response()->json([
                'status' => 'Success',
            ]);
        }
        abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(pegawai $pegawai_id)
    {
        if ($pegawai_id->delete()) {
            return response()->json([
                'status' => 'Success',
            ]);
        }
        abort(400);
    }
}
