<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use League\Csv\Reader;

class ProgramSeeder extends Seeder
{

    /**
     * @throws \League\Csv\Exception
     */
    public function run()
    {
        $csv = Reader::createFromPath('./storage/twc-file.csv', 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset(); //returns 0
        $header = $csv->getHeader();
        $this->command->info(count($csv) . " records found");
        //dd($header);
        $provider_url = null;
        foreach($csv AS $offset => $line) {

            // sanitize provider_url
            $provider_url = $this->fixUrl(strtolower(trim($line['Provider URL'])));
            $program_url = $this->fixUrl(strtolower(trim($line['Program URL'])));

            $program_twist_id = null;
            $provider_twist_id = null;

            $program_twist_id = trim($line['TWIST Program ID']);
            $provider_twist_id = trim($line['TWIST Provider ID']);

            Program::create([
                'twc_provider_id' => $line['Provider #'],
                'twc_program_id' => $line['Program #'],
                'twc_program_status' => $line['Program Status'],

                'provider_name' => $line['Provider Name'],
                'provider_url' => mb_strtolower($provider_url),
                'provider_description' => $line['Description Of Provider'],
                'provider_type' => $line['Institution Type'],
                'provider_campus_name' => $line['Campus Name'],
                'provider_campus_addr1' => $line['Campus Address1'],
                'provider_campus_addr2' => $line['Campus Address2'],
                'provider_campus_city' => mb_strtolower($line['Campus City']),

                'provider_campus_state' => $line['Campus State'],
                'provider_campus_zip' => $line['Campus Zip Code'],
                'provider_campus_county' => mb_strtolower($line['Campus County']),

                'provider_twist_id' => $provider_twist_id,
                'program_twist_id' => $program_twist_id,


                'public_transit' => $line["Information:\nPublic Transit?"],
                'onsite_childcare' => $line["Information:\nOnsite Childcare?"],
                'flexible_hours' => $line["Information:\nFlexible Hours?"],

                'program_name' => $line['Program Name'],
                'program_description' => $line['Program Description'],
                'program_pell_eligible' => $line['Pell Eligible'],
                'program_pre_reqs' => $line['Academic PreRequisites'],
                'program_url' => mb_strtolower($program_url),
                'program_outcome' => $line['Program Outcome'],
                'program_credential_name' => $line['Associated Credential Name'],
                'program_length_hours' => $line["Length:\nContact Hours"],
                'program_length_weeks' => $line["Length:\nWeeks"],
                'program_format' => $line['Program Format'],
                'program_occupation_code1' => $line['Occupation Code 1'],
                'program_occupation_code2' => $line['Occupation Code 2'],
                'program_occupation_code3' => $line['Occupation Code 3'],
                'program_cost_tuition_and_fees' => trim($line[" Required Cost:\nTuition & Fees "]),
                'program_cost_books_and_supplies' => trim($line[" Required Cost:\nBooks Supplies "]),
                'program_cost_other' => trim($line[" Optional Cost:\nOther "]),
//                'outofdistrict_tuition_and_fees' => $line[" (Out Of District)\n
//Cost: \n
//Tuition & Fees\n"],
                'program_total_apprentices' => $line['Number Of Apprentices'],
                'program_start_date' => strtotime($line['Program Start Date']),
                'program_last_updated' => strtotime($line['Program Last Update Date']),

                'city_slug' => Str::slug($line['Campus City'],'-')

            ]) ;

        }


    }



    public function fixUrl($url)
    {
        // If the url is blank.. change it to example.com for now.. and return it.
        if (strlen($url) === 0) {
            #$this->command->error('Got a blank url .. returning https://www.example.com/');
            return 'https://www.example.com/';
        }


        /**
         * keep the longer strings that we have a map for at the top of this array because
         * the more exact match we have up top, the faster we can exit from this loop, and
         * we won't run into wildcard issues. For example
         *
         * we know that http:www.lonestar.eduaccounting-aas.htm needs to be changed to
         * https://www.lonestar.edu/programs-of-study/accounting-aas.htm
         *
         * We keep that at the top of the map, because later on we may have
         * a url that's like http:www.lonestar.edusomethingelse , and we don't have an exact map for this url
         * so the wildcard key of http:www.lonestar.edu will match and give us https://www.lonestar.edu
         * foo
         */
        $bad_to_good_map = [
            'http:www.lonestar.eduaccounting-aas.htm' => 'https://www.lonestar.edu/programs-of-study/accounting-aas.htm',
            'http:www.lonestar.eduuniversitypark.htm' => 'https://www.lonestar.edu/universitypark.htm',
            'www.wc.edu/academics/programs-study/computer-information-systems/information-technology-aas-options' => 'https://www.wc.edu/programs/all-programs/it-degree/index.php',
            'www.wc.edu/academics/programs-study/accounting/accounting-aas' => 'https://www.wc.edu/programs/all-programs/accounting_certificate/index.php',
            'www.lonestar.educyfair.htm' => 'https://www.lonestar.edu/cyfair.htm',
            'http:www.lonestar.educonroecenter.htm' => 'https://www.lonestar.edu/conroecenter.htm',
            'http:www.sanjac.eduvn' => 'https://www.sanjac.edu/vn',
            'https://www.texarkanacollege.edu/study/associatedegreenursing/'=>'https://www.texarkanacollege.edu/study/associate-degree-nursing/adn-basic-program/',
            'http://www.austincareerinstitute.com/index2.html' => 'https://www.austincareerinstitute.edu/',
            'nationaldentalservices.com' => 'https://national-dental-services.com/nds-dental-assisting-school',
            'http:www.lonestar.edu' => 'https://www.lonestar.edu',
            'https:www1.dcccd.edu' => 'https://www1.dcccd.edu',
            'gatewaytc.net' => 'https://www.gatewaytechnicalschool.com',
            'dynamicadvancement.com' => 'https://www.dynamicadvancement.com',
            'navarrocollege' => 'https://www.navarro.edu',
            'http:www.northharriscollege.com' => 'https://www.lonestar.edu/northharris',
            'wc.edu'    => 'https://wc.edu',
            'http:www.sanjac.edu' => 'https://www.sanjac.edu',
            'https://catalog.grayson.edu/catalog/Accounting/index.php' => 'https://cataglog.grayson.edu',
            'https://catalog.grayson.edu/catalog/accounting/index.php' => 'https://catalog.grayson.edu/',
            'http://www.hccs.edu/finder/programs/heatingairconditioningrefrigeration' => 'https://www.hccs.edu',
            'https://www.hccs.edu/programs/areasofstudy/business/accounting/' => 'https://www.hccs.edu/programs/areas-of-study/business/accounting/',
           'https://www.nctc.edu/accounting/index.html' => 'https://nctc.site/accounting/index.html'


        ];

        foreach ($bad_to_good_map as $bad => $good) {
            $pos = strpos($url,$bad);
            if ($pos !== false) {
                $this->command->info("$url will be changed to $good");
                return $good;
            }
        }

        // just check for malformed strings..

        if(substr($url,0,8) == 'http:www') {
           # $this->command->error('Need to fix ' . $url);
            $new_url = str_replace('http:www','https://www', $url);
           // $this->command->info("Changed $url to: $new_url");
            return strtolower($new_url);
        }
        // change http:// to https://
        if ((!(substr($url, 0, 7) == 'http://'))
                &&
            (!(substr($url, 0, 8) == 'https://'))
        ) {
            $new_url = 'https://' . $url;
           // $this->command->info("Fixed $url to => $new_url");
            return strtolower($new_url);
        } else {
            return strtolower($url);
        }

    }



    public function slugify($str)
    {
        return Str::lower(Str::camel($str));
    }

    public function checkIfExists($twc_id)
    {
        echo "Checking if $twc_id is in the DB already " . PHP_EOL;
        // Get all the providers in the DB
        $providers_in_db = Provider::all();
//        foreach ($providers_in_db AS $provider) {
//            dd($provider);
//        }
    }
}
