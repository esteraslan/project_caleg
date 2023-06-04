<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapRealController extends Controller
{
    public function index()
    {
        $title = 'Real Count';
        return view('realcount.rekap', compact('title'));
    }
}
