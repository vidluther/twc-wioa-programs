<?php

namespace App\Http\Livewire;

use Butschster\Head\Facades\Meta;
use Livewire\Component;

use App\Models\Program;

class About extends Component
{

    public $programs;

    public function render()
    {


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


        Meta::setTitle('About the list of TWC - Eligible Training Providers ')
            ->setDescription('This is a list of Eligibile Training Providers for the TWC-WIOA program in Texas');

        return view('livewire.about',
        [
            'num_documents' => $num_documents,
            'cities' => $cities,
            'providers' => $providers,
            'counties' => $counties,
            'average_cost' => $average_cost,
        ]);
    }
}
