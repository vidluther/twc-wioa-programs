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

use Spatie\SchemaOrg\Schema;
use Spatie\SchemaOrg\Graph;
use Spatie\SchemaOrg\ListItem;
use Spatie\SchemaOrg\ItemList;

class Dashboard extends Component
{
    use WithPerPagePagination;
    public ?string $search = null;
    public ?string $search_city = null;


    public function render(Request $request)
    {

        $cities = Program::getUniquesFor('provider_campus_city');

        $programs = Program::search('program_name', $this->search)
            ->orderBy('provider_campus_city', 'ASC')
            ->paginate(30);

        Meta::setDescription("Eligible Training Providers and Programs that teach " . $this->search . " in Texas")
            ->setTitle("Eligible Training Providers that teach " . $this->search . " classes in Texas");

        $this->setOgandCard();

        $schema = $this->buildSchema($programs);

        return view('livewire.dashboard', [
            'cities' => $cities,
            'programs' => $programs,
            'schema' => $schema
        ]);
    }

    private function buildSchema($programs)
    {
        $schema = Schema::itemList();
        $i = 1;



        $itemList = new ItemList();
        $listItems = null;
        foreach($programs AS $program) {
            $listItems[] =  Schema::listItem()
                ->position($i)
                ->url(env('APP_URL') . '/show/' . $program->program_twist_id);
                //->url("https://www.foo.com/show/" . $program->program_twist_id);
            $i++;
        }
        if(!is_null($listItems)) {
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
