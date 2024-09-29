<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class PrivacyPolicyController extends Controller
{
    public function show(Request $request): View
    {

        return view('privacy-policy');
    }
}
