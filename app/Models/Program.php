<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
//use Illuminate\Database\Eloquent\Model;

use Spatie\Sluggable\SlugOptions;

class Program extends \Jenssegers\Mongodb\Eloquent\Model
{
    // protected $connection = 'mongodb';
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['program_name', 'provider_campus_city'])
            ->saveSlugsTo('program_slug');
    }

    public static function getUniquesFor($column)
    {
        //        $records = Program::select($column)->groupBy($column)->orderBy($column)->get();

        $records = Program::select($column)->groupBy($column)->orderBy($column)->get();
        if ($records->count() > 0) {
            return $records;
        } else {
            return false;
        }

    }

    public static function getAverageCost()
    {
        $programs = Program::all();
        $cost = 0;
        $average_cost = 0;

        foreach ($programs as $program) {
            $cost = $cost + (int) $program->program_cost_tuition_and_fees;
        }

        $average = $cost / Program::count();
        $average_cost = number_format($average, '2');

        return $average_cost;
    }

    public static function getOfficeByCounty($county)
    {
        $officeMap = [
            'county' => 'https://www.officeoflocalcountywfc.com',
            'atascosa' => 'https://www.workforcesolutionsalamo.org/',
            'nueces' => 'https://www.workforcesolutionscb.org/',
            'travis' => 'http://www.wfscapitalarea.com/',
            'bexar' => 'http://www.workforcesolutionsalamo.org/',
            'el paso' => 'http://www.borderplexjobs.com/',
            'gray' => 'http://wspanhandle.com/',
            'houston' => 'https://detwork.org/',
            'jasper' => 'https://detwork.org/',
            'polk' => 'https://detwork.org/',
            'angelina' => 'https://detwork.org/',
            'polk' => 'https://detwork.org/',
            'nacodoches' => 'https://detwork.org/',
            'shelby' => 'https://detwork.org/',
            'webb' => 'http://southtexasworkforce.org/',
            'cameron' => 'http://www.wfscameron.org/',
            'taylor' => 'http://www.workforcesystem.org/',
            'knox' => 'http://www.workforcesystem.org/',
            'nolan' => 'http://www.workforcesystem.org/',
            'kent' => 'http://www.workforcesystem.org/',
            'crockett' => 'https://www.cvworkforce.org/',
            'reagan' => 'https://www.cvworkforce.org/',
            'mason' => 'https://www.cvworkforce.org/',
            'menard' => 'https://www.cvworkforce.org/',
            'cooke' => 'https://www.workforcesolutionstexoma.com/',
            'fannin' => 'https://www.workforcesolutionstexoma.com/',
            'grayson' => 'https://www.workforcesolutionstexoma.com/',

            'austin' => 'https://www.wrksolutions.com/find-a-location',

            'brazoria' => 'https://www.wrksolutions.com/find-a-location',
            'chambers' => 'https://www.wrksolutions.com/find-a-location',
            'colorado' => 'https://www.wrksolutions.com/find-a-location',
            'fort bend' => 'https://www.wrksolutions.com/find-a-location',
            'galveston' => 'https://www.wrksolutions.com/find-a-location',
            'harris' => 'https://www.wrksolutions.com/find-a-location',
            'walker' => 'https://www.wrksolutions.com/find-a-location',
            'liberty' => 'https://www.wrksolutions.com/find-a-location',
            'matagorda' => 'https://www.wrksolutions.com/find-a-location',
            'montgomery' => 'https://www.wrksolutions.com/find-a-location',
            'waller' => 'https://www.wrksolutions.com/find-a-location',
            'wharton' => 'https://www.wrksolutions.com/find-a-location',

            'tarrant' => 'https://workforcesolutions.net/',
        ];

        if (array_key_exists($county, $officeMap)) {
            return $officeMap[$county];
        } else {
            return 'https://www.twc.texas.gov/partners/workforce-development-boards-websites';
        }
    }

    public static function getNumberOfProgramsByCity($city)
    {
        $num = Program::where('provider_campus_city', $city)->count();

        return $num;
    }

    public static function getCitySlug($city)
    {
        $slug = Program::select('city_slug')->where('provider_campus_city', $city)->firstOrFail();

        return $slug;
    }

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'program_slug';
    }
}
