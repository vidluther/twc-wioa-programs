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
