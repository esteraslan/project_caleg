<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RealController extends Controller
{
    public function index()
    {
        $title = 'Real Count';
        return view('realcount.index', compact('title'));
    }
}
