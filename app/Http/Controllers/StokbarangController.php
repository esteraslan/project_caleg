<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StokbarangController extends Controller
{
    public function index()
    {
        $title = 'Stok Barang';
        return view('logistik.stok', compact('title'));
    }
}
