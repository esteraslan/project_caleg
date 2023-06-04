<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PendukungController extends Controller
{
    public function index()
    {
        $title = 'Pendukung';
        return view('pendukung.index', compact('title'));
    }
}
