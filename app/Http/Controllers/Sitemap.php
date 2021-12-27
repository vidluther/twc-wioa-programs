<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
class Sitemap extends Controller
{

    public function index(Request $r)
    {

        $programs = Program::all();

        return response()->view('sitemap', compact('programs'))
            ->header('Content-Type', 'text/xml');

    }

}
