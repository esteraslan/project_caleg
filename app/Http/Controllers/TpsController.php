<?php

namespace App\Http\Controllers;
use App\Models\Tps;
use App\Models\Kecamatan;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;
use DB;

class TpsController extends Controller
{
    public function index()
    {
        $title = 'TPS';
        return view('tps.index', compact('title'));
    }

    public function list()
    {
        $query = DB::table('tps as a')
                ->select('a.id','a.name as nm_tps', 'a.nm_kp', 'a.no_rt', 'a.no_rw', 'd.name as desa', 'c.name as kec', 'b.name as kab', 'a.sts')
                ->join('kabupatens as b', 'b.code', '=', 'a.id_kab', 'left')
                ->join('kecamatans as c', 'c.code', '=', 'a.id_kec', 'left')
                ->join('kelurahans as d', 'd.code', '=', 'a.id_kel', 'left')
                ->get();
        return Datatables::of($query)->make();
    }

    public function getkec(Request $request)
    {
        $rows = Kecamatan::where('id_kab', $request->id)->get();
        return response()->json([
            'data'  => $rows
        ]);
    }

    public function getkel(Request $request)
    {
        $rows = Kelurahan::where('id_kec', $request->id)->get();
        return response()->json([
            'data'  => $rows
        ]);
    }

    public function store(Request $request)
    {
        $tps            = new Tps;
        $tps->name      = $request->nama;
        $tps->id_kab    = $request->kab;
        $tps->id_kec    = $request->kec;
        $tps->id_kel    = $request->desa;
        $tps->nm_kp     = $request->nm_kp;
        $tps->no_rt     = $request->no_rt;
        $tps->no_rw     = $request->no_rw;
        $tps->sts       = $request->sts;
        $query          = $tps->save();
        if($query){
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
        $cek = Tps::where('id', $request->id)->count();
        if($cek > 0){
            $row = Tps::where('id', $request->id)->first();
            return response()->json([
                'success'   => true,
                'id'        => $row->id,
                'name'      => $row->name,
                'id_kab'    => $row->id_kab,
                'id_kec'    => $row->id_kec,
                'id_kel'    => $row->id_kel,
                'no_rt'     => $row->no_rt,
                'no_rw'     => $row->no_rw,
                'nm_kp'     => $row->nm_kp,
                'sts'       => $row->sts
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
        $data['name']      = $request->nama;
        $data['id_kab']    = $request->kab;
        $data['id_kec']    = $request->kec;
        $data['id_kel']    = $request->desa;
        $data['nm_kp']     = $request->nm_kp;
        $data['no_rt']     = $request->no_rt;
        $data['no_rw']     = $request->no_rw;
        $data['sts']       = $request->sts;
        $query          = Tps::where('id', $request->id)->update($data);
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
        $cek = Tps::where('id', $request->id)->first();
        if($cek->sts != 1){
            Tps::where('id', $request->id)->delete();
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
