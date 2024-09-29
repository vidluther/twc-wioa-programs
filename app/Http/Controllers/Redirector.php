<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use App\Models\Program;
use Illuminate\Http\Request;

class Redirector extends Controller
{
    public function RedirectShow(Request $request): RedirectResponse
    {
        $program = Program::where('program_twist_id', $request->program_twist_id)->firstOrFail();

        $program_slug = $program->program_slug;
        $new_url = "/$program_slug";

        return redirect($new_url, 301);
    }

    public function RedirectDetails(Request $request): RedirectResponse
    {
        //        dd($request);
        $program = Program::where('twc_program_id', $request->twc_program_id)->firstOrFail();
        //        dd($program);
        $program_slug = $program->program_slug;
        $new_url = "/$program_slug";

        //        dd($new_url);
        return redirect('/'.$program_slug, 301);
    }
}
