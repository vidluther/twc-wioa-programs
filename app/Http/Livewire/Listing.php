<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Livewire\Component;
use Illuminate\Http\Request;
#use Butschster\Head\Packages\Entities\OpenGraphPackage;

use Butschster\Head\Packages\Entities\OpenGraphPackage;

class Listing extends Component
{
    public $programs;

    public function render(Request $request)
    {
        $programs = null;
        $search_in_name = $request->search_in_name;
        $search_for_city = $request->search_for_city;
        $search_for_county = $request->search_for_county;

        if(!is_null($search_in_name)) {
            $programs = Program::where('program_name','LIKE', "%$search_in_name%")
                ->orderBy('provider_campus_city','asc')->paginate(30);

            $searched_for = "NAME: $search_in_name";
            Meta::setDescription("WIOA eligible classes that for : $search_in_name in Texas")
                ->setTitle("WIOA Eligible Providers that teach $search_in_name classes in Texas");
        }

        if(!is_null($search_for_city)) {
            $programs = Program::where('provider_campus_city','LIKE', $search_for_city)->paginate(40);
            $searched_for = "CITY: $search_for_city";
            Meta::setDescription("Eligible Training Providers and classes in: $search_for_city, TX")
                ->setTitle("WIOA Eligible Training Providers in $search_for_city, TX");
        }

        if(!is_null($search_for_county)) {
            $programs = Program::where('provider_campus_county','LIKE', $search_for_county)->paginate(40);
            $searched_for = "COUNTY: $search_for_county";
            Meta::setDescription("Eligible Training Providers and classes in: $search_for_county, TX")
                ->setTitle("WIOA Eligible Training Providers in $search_for_county county TX ");
        }

        // I know there's a better way to do this.. I just don't know what it is.
        // So we're just hacking this together.. where if by now, $programs is not defined
        // run the default paginator.

        if(is_null($programs)) {
            $programs = Program::orderBy('provider_campus_city', 'asc')->paginate(20);
            $searched_for = null;

        }

        /*
         * https://github.com/butschster/LaravelMetaTags#opengraphpackage
        */

        $og = new OpenGraphPackage('og');
        $og->setType('website')
            ->setSiteName('Texas Workforce Commission WIOA Eligible Training Provider and Program List')
            ->setTitle('Texas WFC Eligible Training Provider and Program List')
            ->setUrl(env('APP_URL'));


//        //dd($og);
        Meta::registerPackage($og);
        $cities = Program::getUniquesFor('provider_campus_city');
        $counties = Program::getUniquesFor('provider_campus_county');




        return view('livewire.listing',
        [

            'cities' => $cities,
            'counties' => $counties,
            'programs' => $programs,
            'request'   => $request,
            'searched_for' => $searched_for
        ]
        );
    }
}
