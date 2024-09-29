<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PrivacyPolicyController extends Controller
{
    public function show(Request $request): View
    {

        return view('privacy-policy');
    }
}
