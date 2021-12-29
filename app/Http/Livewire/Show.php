<?php

namespace App\Http\Livewire;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Program;
use Spatie\SchemaOrg\Schema;


class Show extends Component
{

    public function mount(Request $request)
    {
        $program = Program::where('program_twist_id', $request->program_twist_id)->firstOrFail();

        $program_id = $program->twc_program_id;

        return redirect()->route('program-details',['twc_program_id' => $program_id],'301');
    }


    public function render(Request $request)
    {
        // this functionality is now in the Livewire/Details.php file
    }
}
