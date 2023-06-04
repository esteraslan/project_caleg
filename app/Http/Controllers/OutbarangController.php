<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutbarangController extends Controller
{
    public function index()
    {
        $title = 'Pengeluaran Barang';
        return view('logistik.pengeluaran', compact('title'));
    }
}
