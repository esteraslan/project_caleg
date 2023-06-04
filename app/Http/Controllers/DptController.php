<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DptController extends Controller
{
    public function index()
    {
        $title = 'DPT';
        return view('dpt.index', compact('title'));
    }
}
