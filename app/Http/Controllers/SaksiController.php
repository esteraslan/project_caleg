<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SaksiController extends Controller
{
    public function index()
    {
        $title = 'Saksi';
        return view('saksi.index', compact('title'));
    }
}
