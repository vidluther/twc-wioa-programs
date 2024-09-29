<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Sitemap extends Controller
{
    public function index(Request $r): Response
    {

        $programs = Program::all();

        return response()->view('sitemap', compact('programs'))
            ->header('Content-Type', 'text/xml');

    }
}
