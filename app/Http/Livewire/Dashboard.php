<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithPerPagePagination;
use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Illuminate\Http\Request;
use Livewire\Component;
use Spatie\SchemaOrg\ItemList;
use Spatie\SchemaOrg\Schema;

class Dashboard extends Component
{
    use WithPerPagePagination;

    public ?string $search = '';

    public ?string $search_city = null;

    protected $listeners = ['searchedWord', 'searchedCity'];

    public function searchedWord()
    {
        $this->dispatchBrowserEvent('search-updated', ['searchWord' => $this->search]);
        //dd($this->search);
    }

    public function searchedCity()
    {
        $this->dispatchBrowserEvent('search-city', ['searchCity' => $this->search_city]);
        //        dd($this->search_city);
    }

    public function updatedSearch($value) {}

    public function updatedSearchCity($value) {}

    public function render(Request $request)
    {

        $cities = Program::getUniquesFor('provider_campus_city');

        $programs = Program::search('program_name', $this->search)
            ->search('provider_campus_city', $this->search_city)
            ->orderBy('provider_campus_city', 'ASC')
            ->paginate(30);

        Meta::setDescription('Eligible Training Providers List for the TWC WIOA program (etpl twc) ')
            ->setTitle('ETPL - TWC - Eligible Training Provider List for the TWC WIOA program');

        $this->setOgandCard();

        $schema = $this->buildSchema($programs);

        return view('livewire.dashboard', [
            'cities' => $cities,
            'programs' => $programs,
            'schema' => $schema,
        ]);
    }

    private function buildSchema($programs)
    {
        $schema = Schema::itemList();
        $i = 1;

        $itemList = new ItemList;
        $listItems = null;
        foreach ($programs as $program) {
            $listItems[] = Schema::listItem()
                ->position($i)
                ->url(env('APP_URL').'/show/'.$program->program_twist_id);
            //->url("https://www.foo.com/show/" . $program->program_twist_id);
            $i++;
        }
        if (! is_null($listItems)) {
            $itemList->itemListElement(
                $listItems
            );
        }

        return $itemList;
    }

    private function setOgandCard()
    {
        /*
        * https://github.com/butschster/LaravelMetaTags#opengraphpackage
       */

        $og = new OpenGraphPackage('og');
        $og->setType('website')
            ->setSiteName('Texas Workforce Commission WIOA Eligible Training Provider and Program List')
            ->setTitle('List of Eligible Training Providers and Programs for the TWC-WIOA program')

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
            ->setTitle('List of Eligible Training Providers and Programs for the Texas WFC-WIOA Program');

        Meta::registerPackage($card);
    }
}
