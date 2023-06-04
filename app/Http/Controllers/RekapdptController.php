<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapdptController extends Controller
{
    public function index()
    {
        $title = 'Rekap DPT';
        return view('dpt.rekap', compact('title'));
    }
}
