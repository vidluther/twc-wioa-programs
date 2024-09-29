<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Program;
use Illuminate\Http\Request;

class Sitemap extends Controller
{
    public function index(Request $r): Response
    {

        $programs = Program::all();

        return response()->view('sitemap', compact('programs'))
            ->header('Content-Type', 'text/xml');

    }
}
