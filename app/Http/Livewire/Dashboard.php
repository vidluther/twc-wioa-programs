<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Dashboard extends Component
{
    use WithPerPagePagination;
    public ?string $search = null;
    public ?string $search_city = null;


    public function render(Request $request)
    {

        $cities = Program::getUniquesFor('provider_campus_city');

        $programs = Program::search('program_name', $this->search)->paginate(30);

        Meta::setDescription("WIOA eligible providers and classes that teach " . $this->search . " in Texas")
            ->setTitle("WIOA Eligible Providers that teach " . $this->search . " classes in Texas");

        $this->setOgandCard();

        return view('livewire.dashboard', [
            'cities' => $cities,
            'programs' => $programs
        ]);
    }


    private function setOgandCard()
    {
        /*
        * https://github.com/butschster/LaravelMetaTags#opengraphpackage
       */

        $og = new OpenGraphPackage('og');
        $og->setType('website')
            ->setSiteName('Texas Workforce Commission WIOA Eligible Training Provider and Program List')
            ->setTitle('Texas WFC Eligible Training Provider and Program List')

            ->setUrl(request()->url());
        $og->addImage(env('APP_URL') . '/images/texas.svg',[
                'type' => 'image/svg+xml'
            ]
        );
        Meta::registerPackage($og);

        $card = new TwitterCardPackage('twitter');
        $card->setType('summary')
            ->setSite('@vidluther')
            ->setImage(env('APP_URL') . '/images/texas.svg')
            ->setTitle('Directory of Eligible Training Providers and Programs for the Texas WFC-WIOA Program');


        Meta::registerPackage($card);
    }
}