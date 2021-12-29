<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class Redirector extends Controller
{
    public function RedirectShow(Request $request)
    {
        $program = Program::where('program_twist_id', $request->program_twist_id)->firstOrFail();

        $program_id = $program->twc_program_id;
        $new_url = "/details/$program_id";

        return redirect($new_url,301);
    }
}
