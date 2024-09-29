<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class Sitemap extends Controller
{
    public function index(Request $r)
    {

        $programs = Program::all();

        return response()->view('sitemap', compact('programs'))
            ->header('Content-Type', 'text/xml');

    }
}
