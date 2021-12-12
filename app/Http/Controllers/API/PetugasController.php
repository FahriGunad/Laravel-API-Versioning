<?php

namespace App\Http\Controllers\API;

use App\Models\level;
use App\Models\petugas;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use Facade\FlareClient\Api;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class PetugasController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {

            $token = md5($request->username . time());

            $petugas = Auth::user();
            $petugas->api_token = $token;

            if ($petugas->save()) {
                return response()->json([
                    'status' => 'Success',
                    'nama' => $petugas->nama_petugas,
                    'token' => $token,
                    'id_level' => $petugas->id_level,
                ]);
            } else {
                return response('0');
            }
        } else {
            return response('0');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $result = petugas::join('level', 'petugas.id_level', '=', 'level.id_level')->select('id', 'nama_petugas', 'username', 'nama_level')->get();
        return $result;
    }

    public function search(Request $request)
    {

        $request->validate([
            'search' => 'required',
            'username' => 'required'
        ]);

        if ($request->search == "0") {
            $result = petugas::join('level', 'petugas.id_level', '=', 'level.id_level')
            ->select('id', 'nama_petugas', 'username', 'nama_level')
            ->where('username', $request->username)->get();
    
            foreach($result as $result){
            return response()->json([
                
                'id'=> $result['id'],
                'nama_petugas'=> $result['nama_petugas'],
                'username'=> $result['username'],
                'nama_level'=> $result['nama_level'],
              ]);
            }
        } else {
            $result = petugas::join('level', 'petugas.id_level', '=', 'level.id_level')
            ->select('id', 'nama_petugas', 'username', 'nama_level')
            ->where('nama_petugas','like',"%".$request->search."%")
            ->orWhere('id','like',"%".$request->search."%")
            ->orWhere('username','like',"%".$request->search."%")
            ->orWhere('nama_level','like',"%".$request->search."%")
            ->get();

            return $result;

        //     $pegawai = DB::table('pegawai')
		// ->where('pegawai_nama','like',"%".$cari."%");
        }
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
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        $id_level = level::select('id_level')->where('nama_level', $request->level)->get();
        foreach ($id_level as $id_level) {

            $post = petugas::create([
                'nama_petugas' => $request->nama_petugas,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'id_level' => $id_level['id_level'],
            ]);

            if ($post) {
                return response()->json([
                    'status' => 'Success',
                ]);
            } 
            abort(400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function show(petugas $petugas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, petugas $petugas_id)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'username' => 'required',
            'password' => 'required',
            'level' => 'required',
        ]);

        if ($request->password == "0") {
            $id_level = level::select('id_level')->where('nama_level', $request->level)->get();
            foreach ($id_level as $id_level) {
                $model = $petugas_id;
                $model->nama_petugas = $request->nama_petugas;
                $model->username = $request->username;

                if ($model->save()) {
                    return response()->json([
                        'status' => 'Success',
                    ]);
                }
                abort(400);
            }
        } else {
            $id_level = level::select('id_level')->where('nama_level', $request->level)->get();
            foreach ($id_level as $id_level) {
                $model = $petugas_id;
                $model->nama_petugas = $request->nama_petugas;
                $model->username = $request->username;
                $model->password = bcrypt($request->password);

                if ($model->save()) {
                    return response()->json([
                        'status' => 'Success',
                    ]);
                }
                abort(400);
            }
        }
        abort(400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\petugas  $petugas
     * @return \Illuminate\Http\Response
     */
    public function destroy(petugas $petugas_id)
    {
        if ($petugas_id->delete()) {
            return response()->json([
                'status' => 'Success',
            ]);
        }
        abort(400);
    }
}
