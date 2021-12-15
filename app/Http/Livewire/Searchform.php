<?php

namespace App\Http\Livewire;

use App\Models\Program;
#use http\Env\Request;
use Livewire\Component;
use Illuminate\Http\Request;

class Searchform extends Component
{
    public string $searched_for;
    public function mount()
    {
        $cities = Program::getUniquesFor('provider_campus_city');
        $counties = Program::getUniquesFor('provider_campus_county');
    }
    public function render(Request $request)
    {
        $cities = Program::getUniquesFor('provider_campus_city');
        $counties = Program::getUniquesFor('provider_campus_county');
        $searched_for = '';

        return view('livewire.searchform',
            [

                'cities' => $cities,
                'counties' => $counties,
                'searched_for' => $searched_for
            ]);
    }
}
