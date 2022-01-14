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
            $provider_url = $this->fixUrl(trim($line['Provider URL']));
            $program_url = $this->fixUrl(trim($line['Program URL']));

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
        if(strlen($url) ===0) {
            #$this->command->error('Got a blank url .. returning https://www.example.com/');
            return 'https://www.example.com/';
        }

        # fix for El Centro College (dcccd.edu)
        # https:www1.dcccd.edu
        if(substr($url,0,20) == 'https:www1.dcccd.edu') {
            //$new_url = str_replace('https:www1.dcccd.edu','https://www1.dcccd.edu/', $url);
            // since most of the newly formed urls were ending up being 404s.. we're just sending directly to dcccd.edu
            // home page.
            $new_url = 'https://www1.dcccd.edu/';
            $this->command->info("Changed $url to ". $new_url);
            //die;
            return $new_url;
        }



        # fix for lonestar edu links
        #http:www.lonestar.eduFJDJDJ
        if(substr($url,0,21) == 'http:www.lonestar.edu') {
           // $new_url = str_replace('http:www.lonestar.edu','https://www.lonestar.edu/', $url);
            $new_url = 'https://www.lonestar.edu/';
            $this->command->info("Changed $url to ". $new_url);
            //die;
            return $new_url;
        }
        // navarro college (navarrocollege.edu)
        if(str_contains($url, 'navarrocollege.edu')) {
            $new_url = 'https://navarrocollege.edu';
            $this->command->info("Changed $url to " . $new_url);
            return $new_url;
        }

        // wc.edu
        if(str_contains($url, 'wc.edu')) {
            $new_url = 'https://wc.edu';
            $this->command->info("Changed $url to " . $new_url);
            return $new_url;
        }
        # North Harris College
        #  http:www.northharriscollege.com
        if(str_contains($url, 'northharriscollege.com')) {
            $new_url = 'https://www.lonestar.edu/northharris';
            $this->command->info("Changed $url to " . $new_url);
            return $new_url;
        }

//        if(substr($url,0,21) == 'http:www.northharriscollege.com') {
//            // $new_url = str_replace('http:www.northharriscollege.com','https://www.northharriscollege.com/', $url);
//            $new_url = 'https://www.northharriscollege.com/';
//            $this->command->info("Changed $url to ". $new_url);
//            //die;
//            return $new_url;
//        }

        if(Str::startsWith($url,'http:www.sanjac.edu')) {
            //$new_url = str_replace('http:www.sanjac.edu','https://www.sanjac.edu/', $url);
            $new_url = 'https://www.sanjac.edu';
            $this->command->info("Changed $url to ". $new_url);
            return $new_url;
        }
        //https://catalog.grayson.edu/catalog/accounting/index.php

        if(Str::startsWith($url,'https://catalog.grayson.edu')) {
            //$new_url = str_replace('http:www.sanjac.edu','https://www.sanjac.edu/', $url);
            $new_url = 'https://catalog.grayson.edu/';
            $this->command->info("Changed $url to ". $new_url);
            return $new_url;
        }
        //https://www.hccs.edu/

        if(Str::startsWith($url,'https://www.hccs.edu/')) {
            //$new_url = str_replace('http:www.sanjac.edu','https://www.sanjac.edu/', $url);
            $new_url = 'https://www.hccs.edu/';
            $this->command->info("Changed $url to ". $new_url);
            return $new_url;
        }

        // If the start of the url is http:www , change it to https://
        if(substr($url,0,8) == 'http:www') {
           # $this->command->error('Need to fix ' . $url);
            $new_url = str_replace('http:www','https://www', $url);
            $this->command->info("Changed $url to: $new_url");
            return $new_url;
        }



        // If the start of the string doesn't have http or https, add it.

        if ((!(substr($url, 0, 7) == 'http://'))
                &&
            (!(substr($url, 0, 8) == 'https://'))
        ) {

            $new_url = 'https://' . $url;
            #$this->command->info("Fixed $url to => $new_url");
            return $new_url;
        } else {
            return $url;
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
