<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PrivacyPolicyController extends Controller
{
    public function show(Request $request)
    {

        return view('privacy-policy');
    }
}
