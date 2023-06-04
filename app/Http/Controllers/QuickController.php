<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuickController extends Controller
{
    public function index()
    {
        $title = 'Quick Count';
        return view('quickcount.index', compact('title'));
    }
}
