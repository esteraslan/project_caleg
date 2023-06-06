<?php

namespace App\Http\Controllers;
use App\Models\Relawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;


class RelawanController extends Controller
{
    public function index()
    {
        $title = 'Relawan';
        return view('relawan.index', compact('title'));
    }

    public function list()
    {
        $query = Relawan::all();
        return Datatables::of($query)->make();
    }

    public function store(Request $request)
    {
        $relawan                = new Relawan;
        $relawan->name          = $request->nama;
        $relawan->nik           = $request->nik;
        $relawan->jenis_kelamin = $request->jenis_kelamin;
        $relawan->tmp_lahir     = $request->tmp_lahir;
        $relawan->tgl_lahir     = $request->tgl_lahir;
        $relawan->organisasi    = $request->organisasi;
        $relawan->no_hp         = $request->no_hp;
        $relawan->sts           = $request->sts;
        $query                  = $relawan->save();
        if($query){
            $user           = new User;
            $user->name     = $request->nama;
            $user->username = $request->no_hp;
            $user->password = bcrypt(date('dmY', strtotime($request->tgl_lahir)));
            $user->level    = 'Relawan';
            $user->save();
            return response()->json([
                'success'   => true,
                'msg'       => 'Insert berhasil.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Insert gagal.'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $cek = Relawan::where('id', $request->id)->count();
        if($cek > 0){
            $row = Relawan::where('id', $request->id)->first();
            return response()->json([
                'success'       => true,
                'id'            => $row->id,
                'name'          => $row->name,
                'nik'           => $row->nik,
                'jenis_kelamin' => $row->jenis_kelamin,
                'tmp_lahir'     => $row->tmp_lahir,
                'tgl_lahir'     => $row->tgl_lahir,
                'organisasi'    => $row->organisasi,
                'no_hp'         => $row->no_hp,
                'sts'           => $row->sts
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Data tidak tersedia.'
            ]);
        }
    }

    public function update(Request $request)
    {
        $data['name']           = $request->nama;
        $data['nik']            = $request->nik;
        $data['jenis_kelamin']  = $request->jenis_kelamin;
        $data['tmp_lahir']      = $request->tmp_lahir;
        $data['tgl_lahir']      = $request->tgl_lahir;
        $data['organisasi']     = $request->organisasi;
        $data['no_hp']          = $request->no_hp;
        $data['sts']            = $request->sts;
        $query = Relawan::where('id', $request->id)->update($data);
        if($query){
            return response()->json([
                'success'   => true,
                'msg'       => 'Update berhasil.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Update gagal.'
            ]);
        }
    }

    public function destroy(Request $request)
    {
        $cek = Relawan::where('id', $request->id)->first();
        if($cek->sts != 1){
            Relawan::where('id', $request->id)->delete();
            return response()->json([
                'success'   => true,
                'msg'       => 'Delete berhasil.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Delete gagal. Status Aktif'
            ]);
        }
    }
}
