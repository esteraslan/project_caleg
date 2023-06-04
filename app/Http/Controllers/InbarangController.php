<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InbarangController extends Controller
{
    public function index()
    {
        $title = 'Penerimaan Barang';
        return view('logistik.penerimaan', compact('title'));
    }
}
