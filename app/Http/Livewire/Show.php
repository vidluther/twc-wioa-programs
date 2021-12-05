<?php

namespace App\Http\Livewire;

use Butschster\Head\Facades\Meta;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Program;

class Show extends Component
{
    public function render(Request $request)
    {
#        $program = Program::where('program_twist_id', $request->program_twist_id)->get();
        $program = Program::where('program_twist_id', $request->program_twist_id)->firstOrFail();

        Meta::setTitle($program->program_name)
            ->prependTitle('Details about ')
            ->setDescription($program->program_description);

        $local_twc_website = Program::getOfficeByCounty($program->provider_campus_county);

        return view('livewire.show', [
                'program_twist_id' => $request->program_twist_id,
                'program' => $program,
                'local_twc_website' => $local_twc_website
            ]
        );
    }
}
