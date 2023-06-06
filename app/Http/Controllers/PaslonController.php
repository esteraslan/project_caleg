<?php

namespace App\Http\Controllers;
use App\Models\Paslon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use DataTables;

class PaslonController extends Controller
{
    public function index()
    {
        $title = 'Calon';
        return view('paslon.index', compact('title'));
    }

    public function list()
    {
        $query = Paslon::orderBy('no_urut', 'asc')->get();
        return Datatables::of($query)->make();
    }

    public function store(Request $request)
    {
        $image = $request->file('gambar');
        $filetype       = $image->extension();
        $filename       = 'paslon'.time();
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]); 
        $request->gambar->move('dist/img/paslon', $filename.'.'.$filetype);

        $calon          = new Paslon;
        $calon->name    = $request->nama;
        $calon->partai  = $request->partai;
        $calon->no_urut = $request->no_urut;
        $calon->sts     = $request->sts;
        $calon->gambar  = $filename.'.'.$filetype;
        $query          = $calon->save();
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
        $qry = Paslon::where('id', $request->id)->first();
        if($qry){
            return response()->json([
                'success'   => true,
                'id'        => $qry->id,
                'nama'      => $qry->name,
                'partai'    => $qry->partai,
                'no_urut'   => $qry->no_urut,
                'sts'       => $qry->sts,
                'gambar'    => $qry->gambar
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Data not found.'
            ]);
        }
    }

    public function update(Request $request)
    {
        if($request->file('gambar') == ''){
            $data['name']    = $request->nama;
            $data['partai']  = $request->partai;
            $data['no_urut'] = $request->no_urut;
            $data['sts']     = $request->sts;
            $query           = Paslon::where('id', $request->id)->update($data);
            if($query){
                return response()->json([
                    'success'   => true,
                    'msg'       => 'Update success.'
                ]);
            }else{
                return response()->json([
                    'success'   => false,
                    'msg'       => 'Update failed.'
                ]);
            }
        }else{
            $calon = Paslon::where('id', $request->id)->first();
            $image_path = 'dist/img/paslon/'.$calon->gambar; 
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $image      = $request->file('gambar');
            $filetype   = $image->extension();
            $filename   = 'paslon'.time();
            $request->validate([
                'gambar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]); 
            $request->gambar->move('dist/img/paslon', $filename.'.'.$filetype);
    
            $data['name']    = $request->nama;
            $data['partai']  = $request->partai;
            $data['no_urut'] = $request->no_urut;
            $data['sts']     = $request->sts;
            $data['gambar']  = $filename.'.'.$filetype;
            $query           = Paslon::where('id', $request->id)->update($data);
            if($query){
                return response()->json([
                    'success'   => true,
                    'msg'       => 'Update success.'
                ]);
            }else{
                return response()->json([
                    'success'   => false,
                    'msg'       => 'Update failed.'
                ]);
            }
        }
    }

    public function destroy(Request $request)
    {
        $calon = Paslon::where('id', $request->id)->first();
        $image_path = 'dist/img/paslon/'.$calon->gambar; 
        if(File::exists($image_path)) {
            File::delete($image_path);
        }
        $query = Paslon::where('id', $request->id)->delete();
        if($query){
            return response()->json([
                'success'   => true,
                'msg'       => 'Delete success.'
            ]);
        }else{
            return response()->json([
                'success'   => false,
                'msg'       => 'Delete failed.'
            ]);
        }
    }
}
