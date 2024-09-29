<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Livewire\Component;

class About extends Component
{
    public $programs;

    public function render()
    {
        $this->setOgandCard();
        $schema = $this->buildSchema();

        $num_documents = Program::count();
        $cost = 0;
        $count_unique_providers = 0;
        $count_unique_cities = 0;
        $average_cost = 0;

        if ($num_documents > 0) {
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

    private function buildSchema() {}

    /**
     * I know.. I know.. I'm repeating this..and this will probably come to bite me in the ass later.
     */
    private function setOgandCard()
    {
        /*
        * https://github.com/butschster/LaravelMetaTags#opengraphpackage
       */

        $og = new OpenGraphPackage('og');
        $og->setType('website')
            ->setSiteName('Texas Workforce Commission WIOA Eligible Training Provider and Program List')
            ->setTitle('About the Texas WFC Eligible Training Provider and Program List')

            ->setUrl(request()->url());
        $og->addImage(env('APP_URL').'/images/texas.svg', [
            'type' => 'image/svg+xml',
        ]
        );
        Meta::registerPackage($og);

        $card = new TwitterCardPackage('twitter');
        $card->setType('summary')
            ->setSite('@vidluther')
            ->setImage(env('APP_URL').'/images/texas.svg')
            ->setTitle('Directory of Eligible Training Providers and Programs for the Texas WFC-WIOA Program');

        Meta::registerPackage($card);
    }
}
