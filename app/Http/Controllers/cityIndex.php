<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Jenssegers\Mongodb\Eloquent\Model;
use MongoDB\Operation\Aggregate;

/**
 * Helps show an index of cities that have ETPs.
 */
class cityIndex extends Controller
{


    public function listCities()
    {

#        $grouped = Program::groupBy('provider_campus_city')->get(['provider_campus_city','program_name'])->toArray();
        # Ideally this should work.. and give us a count of records per city.. but
        # it's not working in this package..https://github.com/jenssegers/laravel-mongodb/issues/1763
        # so we'll have to do this manually.
        // $grouped = Program::groupBy('provider_campus_city')->aggregate('count',['provider_campus_city'])->get()->toArray();

        $cities = Program::getUniquesFor('provider_campus_city')->toArray();

        $grouped = [];
        foreach($cities AS $city) {
            // get the number of records with this city name
            $cityName = $city['provider_campus_city'];
            $num = Program::getNumberOfProgramsByCity($cityName);
            $grouped[$cityName] = $num;
         }
        //sdd($grouped);

        return view('cities.listofcities',
        [
            'grouped' => $grouped
        ]);

        // basically we need to get a count of programs by city.
    }


    public function listByCity(Request $request)
    {
        $city = $request->city;

        $programs = Program::where('provider_campus_city', $city)->paginate(50);


        return view ('cities.listbycity',
        [
            'city' => ucwords($city),
            'programs' => $programs
        ]
        );
    }

}
