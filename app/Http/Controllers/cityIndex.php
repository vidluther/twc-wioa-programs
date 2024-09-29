<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Illuminate\Http\Request;
use Illuminate\View\View;
use MongoDB\Operation\Aggregate;

/**
 * Helps show an index of cities that have ETPs.
 */
class cityIndex extends Controller
{
    public function listCities(): View
    {

        Meta::setDescription('Cities that have an ETP for the TWC-WIOA program in Texas')
            ->setTitle('Cities in Texas that have an Eligible Training Provider for TWC');
        //        $grouped = Program::groupBy('provider_campus_city')->get(['provider_campus_city','program_name'])->toArray();
        // Ideally this should work.. and give us a count of records per city.. but
        // it's not working in this package..https://github.com/jenssegers/laravel-mongodb/issues/1763
        // so we'll have to do this manually.
        // $grouped = Program::groupBy('provider_campus_city')->aggregate('count',['provider_campus_city'])->get()->toArray();

        $columns = ['provider_campus_city', 'city_slug'];
        $cities = Program::getUniquesFor('provider_campus_city');
        // Now that we have a list of cities, get the number of programs per city.

        //        dd(count($cities));
        $grouped = [];
        //        foreach($cities AS $city) {
        //            // get the number of records with this city name
        //            $cityName = $city['provider_campus_city'];
        //            $num = Program::getNumberOfProgramsByCity($cityName);
        //            $citySlug = Program::getCitySlug($cityName);
        //            //echo $citySlug . '<br />';
        //            $grouped[$cityName] = $num;
        //         }
        //
        //
        //        dd($grouped);

        return view('cities.listofcities',
            [
                'cities' => $cities,
                'grouped' => $grouped,
            ]);

        // basically we need to get a count of programs by city.
    }

    public function listByCity(Request $request): View
    {
        $city = $request->city;

        $infoForMeta = Program::where('city_slug', $city)->firstOrFail();

        Meta::setDescription('Eligible Training Providers List for the TWC WIOA program (etpl twc) ')
            ->setTitle('List of Eligible Providers and Programs in '.ucwords($infoForMeta->provider_campus_city)
                .','.$infoForMeta->provider_campus_state);

        // dd($city);
        $programs = Program::where('city_slug', $city)->paginate(30);

        return view('cities.listbycity',
            [
                'city' => ucwords($city),
                'programs' => $programs,
            ]
        );
    }
}
