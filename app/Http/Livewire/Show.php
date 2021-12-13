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
            ->setKeywords($program->program_name. ', '.  $program->provider_campus_city .
                ', '. $program->provider_campus_state
                .', ' . $program->provider_campus_zip
            )
            ->setDescription($program->program_description . " classes in " . $program->provider_campus_city . " ".
            $program->provider_campus_state);

        $local_twc_website = Program::getOfficeByCounty($program->provider_campus_county);

        if(is_numeric($program->program_cost_tuition_and_fees)) {
            $program->cost = '$' . number_format($program->program_cost_tuition_and_fees, 2);
        } else {
            $program->cost = 'unknown';
        }

        return view('livewire.show', [
                'program_twist_id' => $request->program_twist_id,
                'program' => $program,
                'local_twc_website' => $local_twc_website
            ]
        );
    }
}
