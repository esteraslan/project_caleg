<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapQuickController extends Controller
{
    public function index()
    {
        $title = 'Quick Count';
        return view('quickcount.rekap', compact('title'));
    }
}
