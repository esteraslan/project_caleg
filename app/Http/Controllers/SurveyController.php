<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index()
    {
        $title = 'Survey';
        return view('survey.index', compact('title'));
    }
}
