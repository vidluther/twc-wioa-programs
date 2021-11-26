<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Program;

class Search extends Component
{
    public $county;
    public $city;

    public function render()
    {
        $cities = Program::getUniquesFor('provider_campus_city');
        $counties = Program::getUniquesFor('provider_campus_county');
        return view('livewire.search',[
            'counties' => $counties,
            'cities'    => $cities
        ]);
    }
}
