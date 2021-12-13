<?php

namespace App\Http\Livewire;

use Butschster\Head\Facades\Meta;
use Livewire\Component;

use App\Models\Program;

class About extends Component
{
    public $num_documents;
    public $programs;
    public function render()
    {
        $programs = null ;
        if(is_null($programs)) {
            $programs = Program::orderBy('provider_campus_city', 'asc')->paginate(20);
            $searched_for = null;

        }

        $num_documents = Program::count();
        $cost = 0;
        $count_unique_providers = 0;
        $count_unique_cities = 0;
        $average_cost = 0;
        if($num_documents > 0 ) {


            $cities = Program::getUniquesFor('provider_campus_city');
            $counties = Program::getUniquesFor('provider_campus_county');
            $providers = Program::getUniquesFor('twc_provider_id');
            $average_cost = Program::getAverageCost();


        }


        Meta::setTitle('About')
            ->prependTitle('TexasWFC.com ')
            ->setDescription('This is a list of Eligibile Training Providers for the TWC-WIOA program in Texas');

        return view('livewire.about',
        [
            'num_documents' => $num_documents,
            'cities' => $cities,
            'providers' => $providers,
            'counties' => $counties,
            'programs' => $programs,
            'average_cost' => $average_cost,
        ]);
    }
}
