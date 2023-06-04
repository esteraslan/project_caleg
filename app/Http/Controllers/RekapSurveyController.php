<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RekapSurveyController extends Controller
{
    public function index()
    {
        $title = 'Rekap Survey';
        return view('survey.rekap', compact('title'));
    }
}
