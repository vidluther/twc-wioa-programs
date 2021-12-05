<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
#use Illuminate\Database\Eloquent\Model;

use Jenssegers\Mongodb\Eloquent\Model;


class Program extends Model
{
   // protected $connection = 'mongodb';
    use HasFactory;

    public static function getUniquesFor($column)
    {
        $records = Program::select($column)->groupBy($column)->orderBy($column)->get();
        if($records->count() > 0 ) {
            return $records;
        } else {
            return false;
        }

    }

    public static function getAverageCost() {
        $programs = Program::all();
        $cost = 0 ;
        $average_cost = 0;

        foreach($programs AS $program) {
            $cost = $cost + (int) $program->program_cost_tuition_and_fees;
        }

        $average = $cost / Program::count();
        $average_cost = number_format($average, '2');
        return $average_cost;
    }

    public static function getOfficeByCounty($county) {
        $officeMap = array (
            'county' => 'https://www.officeoflocalcountywfc.com',
            'atascosa' => 'https://www.workforcesolutionsalamo.org/',
            'nueces' => 'https://www.workforcesolutionscb.org/'
        );

        if(array_key_exists($county, $officeMap)) {
            return $officeMap[$county];
        } else {
            return 'https://www.twc.texas.gov/';
        }
    }

//    public static function getProgramName($program_twist_id) {
//        $program = Program::select($column)->groupBy($column)->orderBy($column)->get();
//
//        return $this->getAttribute('program_name');
//    }

//    public static function getCities()
//    {
//        $cities = Program::select('provider_campus_city')->distinct()->get();
//        if($cities->count() > 0) {
//            return $cities;
//        } else {
//            return false;
//        }
//
//    }
}
