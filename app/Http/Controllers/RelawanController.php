<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RelawanController extends Controller
{
    public function index()
    {
        $title = 'Relawan';
        return view('relawan.index', compact('title'));
    }
}
