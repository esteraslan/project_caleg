<?php

namespace App\Http\Controllers;

use App\Models\Pendukung;
use App\Models\Relawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;

class PendukungController extends Controller
{
    public function index()
    {
        $title = 'Pendukung';
        return view('pendukung.index', compact('title'));
    }


    public function list()
    {
        $query = Pendukung::all();
        return Datatables::of($query)->make();
    }

    public function getrelawan(Request $request)
    {
      
        $relawan = Relawan::select('id', 'name')->get();
        return view('pendukung.getrelawan', compact('relawan'));
    }

    public function store(Request $request)
    {
        $image = $request->file('gambar');
        $filetype       = $image->extension();
        $filename       = 'pendukung'.time();
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]); 
        $request->gambar->move('dist/img/pendukung', $filename.'.'.$filetype);

        $pendukung                      = new Pendukung();
        $pendukung->id_relawan          = $request->id_relawan;
        $pendukung->name                = $request->nama;
        $pendukung->no_ktp              = $request->no_ktp;
        $pendukung->no_kk               = $request->no_kk;
        $pendukung->alamat              = $request->alamat;
        $pendukung->keterangan          = $request->keterangan;
        $pendukung->jenis_kelamin       = $request->jenis_kelamin;
        $pendukung->gambar              = $filename.'.'.$filetype;
        $query                          = $pendukung->save();
        if($query){
            return response()->json([
                'success'   => true,
                'msg'       => 'Upload success.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Upload failed.'
            ]);
        }
    }

    public function edit(Request $request)
    {
        $qry = Pendukung::where('id', $request->id)->first();
        if($qry){
            return response()->json([
                'success'            => true,
                'id'                 => $qry->id,
                'id_relawan'         => $qry->id_relawan,
                'nama'               => $qry->name,
                'no_ktp'             => $qry->no_ktp,
                'no_kk'              => $qry->no_kk,
                'alamat'             => $qry->alamat,
                'keterangan'          => $qry->keterangan,
                'jenis_kelamin'       => $qry->jenis_kelamin,
                'gambar'              => $qry->gambar 
            ]);
        }else{
            return response()->json([
                'success' => false,
                'msg' => 'Data not found'
            ]);
        }
    }
    public function update(Request $request)
    {

        $qry = Pendukung::find($request->id);

        if ($request->file('gambar') == '') {
            $data['id_relawan']    = $request->id_relawan;
            $data['name']          = $request->nama;
            $data['no_ktp']        = $request->no_ktp;
            $data['no_kk']         = $request->no_kk;
            $data['alamat']        = $request->alamat;
            $data['keterangan']    = $request->keterangan;
            $data['jenis_kelamin'] = $request->jenis_kelamin;
            $query                 = Pendukung::where('id', $request->id)->update($data);

            if ($query) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Pembaruan berhasil.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Pembaruan gagal.'
                ]);
            }
        } else {
            $qry = Pendukung::where('id', $request->id)->first();
            $image_path = 'dist/img/pendukung/'.$qry->gambar;

            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $image = $request->file('gambar');
            $filetype = $image->extension();
            $filename = 'pendukung' . time();

            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            $request->gambar->move('dist/img/pendukung', $filename . '.' . $filetype);

            $data['id_relawan']         = $request->id_relawan;
            $data['name']               = $request->nama;
            $data['no_ktp']             = $request->no_ktp;
            $data['no_kk']              = $request->no_kk;
            $data['alamat']             = $request->alamat;
            $data['keterangan']         = $request->keterangan;
            $data['jenis_kelamin']      = $request->jenis_kelamin;
            $data['gambar']             = $filename . '.' . $filetype;
            $query                      = Pendukung::where('id', $request->id)->update($data);
          

            if ($query) {
                return response()->json([
                    'success' => true,
                    'msg' => 'Pembaruan berhasil.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => 'Pembaruan gagal.'
                ]);
            }
        }
    }
    public function destroy(Request $request)
    {
        $cek = Pendukung::where('id', $request->id)->first();
        if($cek->sts != 1){
            Pendukung::where('id', $request->id)->delete();
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
