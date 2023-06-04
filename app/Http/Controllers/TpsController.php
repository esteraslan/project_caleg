<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function index()
    {
        $title = 'TPS';
        return view('tps.index', compact('title'));
    }
}
