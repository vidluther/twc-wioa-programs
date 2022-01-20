<?php

namespace Database\Seeders;

use App\Models\Program;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use League\Csv\Reader;

use GuzzleHttp\Psr7;
#use GuzzleHttp\Exception\ClientException;

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
        $counter =1;
        foreach($csv AS $offset => $line) {

            // sanitize provider_url
          $provider_url = $this->fixUrl(strtolower(trim($line['Provider URL'])),$line['Program Name']);

          // Sanitize Program URL
          $program_url = $this->fixUrl(strtolower(trim($line['Program URL'])),$line['Program Name']);




           // $this->checkUrl($program_url,$line['Program Name'],);
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
            //$this->command->info($counter);
            $counter++;
        }


    }

    public function checkUrl($url, $program_name) {
        #echo $this->command->info("Going to check if $url is working or not");
        $client = new \GuzzleHttp\Client();
       // echo $this->command->info("Checking on $program_name");

        try {
            $response = $client->request('GET', $url,['allow_redirects' => true, 'verify' => false]);
        } catch (ClientException $e) {
            echo $this->command->error("$url for $program_name is returning " . $e->getResponse()->getStatusCode());
           // echo Psr7\Message::toString($e->getRequest());
         //   echo $e->getResponse()->getStatusCode();
        } catch (ServerException $s) {
            echo $this->command->error("$url for $program_name is returning " . $s->getResponse()->getStatusCode());
        } catch (RequestException $r) {
            echo $this->command->error("Could not talk to $url for $program_name because.." . $r->getResponse());
        }




    }

    public function fixUrl($url,$program_name)
    {
        // If the url is blank.. change it to example.com for now.. and return it.
        if (strlen($url) === 0) {
            #$this->command->error('Got a blank url .. returning https://www.example.com/');
            return 'https://www.example.com/';
        }

        // if we have alamo.edu in the url, we just send people to the search url for the program name
        $alamo_in_url = strpos($url,'alamo.edu');
        if($alamo_in_url !== false) {
            return 'https://www.alamo.edu/search/?q=' . rawurlencode($program_name)   ;

        }

        // if we have alvincollege.edu in the url, we just send people to the search url for the program name
        $alvin_in_url = strpos($url,'alvincollege');
        if($alvin_in_url !== false) {
            return 'https://www.alvincollege.edu/search/?q=' . rawurlencode($program_name)   ;
        }

        // Asher.edu search
        // https://asher.edu/?s=covid+stuff

        $asher_in_url = strpos($url,'asher.edu');
        if($asher_in_url !== false) {
            return 'https://asher.edu/?s=' . rawurlencode($program_name)   ;

        }

        // ACTX.edu search
        // https://www.actx.edu/searchac/search.html?q=wind

        $actx_in_url = strpos($url,'actx.edu');
        if($actx_in_url !== false) {
            return 'https://www.actx.edu/searchac/search.html?q=' . rawurlencode($program_name)   ;


        }

        // collin
        // https://www.collin.edu/search.html?q=nurse+training
        $collin_in_url = strpos($url,'collin.edu');
        if($collin_in_url !== false) {
            return 'https://www.collin.edu/search.html?q=' . rawurlencode($program_name)   ;
        }

        // computerminds.com
        //https://computerminds.com/?s=microsoft+training

        $computerminds_in_url = strpos($url,'computerminds.com');
        if($computerminds_in_url !== false) {
            return 'https://computerminds.com/?s=' . rawurlencode($program_name)   ;
        }

        // grayson
        // https://catalog.grayson.edu/2021-2022/search.php?q=office+and+computer+tech
        $grayson_in_url = strpos($url,'grayson.edu');
        if($grayson_in_url !== false) {
            return 'https://catalog.grayson.edu/2021-2022/search.php?q=' . rawurlencode($program_name)   ;
        }

        // blinn
        //https://www.blinn.edu/vocational-nursing/index.html?ss360Query=truck+driving
        $blinn_in_url = strpos($url,'blinn.edu');
        if($blinn_in_url !== false) {
            return 'https://www.blinn.edu/?ss360Query=' . rawurlencode($program_name)   ;
        }

        // austincc
        //https://www.blinn.edu/vocational-nursing/index.html?ss360Query=truck+driving
        $austincc_in_url = strpos($url,'austincc.edu');
        if($austincc_in_url !== false) {
            return 'https://www.austincc.edu/search?search=' . rawurlencode($program_name)   ;
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
            'www.consultingsolutions.net' => 'https://www.twc.texas.gov',
            'austin.cc.tx.us' => 'https://www.austincc.edu/',
            'ntxapics.org' => 'https://www.ascm.org/learning-development/',
            'https:www.angelo.edu'=>'https://www.angelo.edu/',
            'absolutecprdallas.com' => 'https://absolutecprdallas.com/',

            'cis.actx.edu' => 'https://www.actx.edu/',
            'cp4566.edgewebhosting.net' => 'https://www.twc.texas.gov/',
            'www.goapprenticeship.com' => 'http://www.goapprenticeship.com/',
            'www.accd.edu' => 'https://www.alamo.edu',
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
           'https://www.nctc.edu/accounting/index.html' => 'https://nctc.site/accounting/index.html',
            'https://www.hccs.edu/' => 'https://www.hccs.edu/',
            'altierus.edu/campus/houstonbissonnet' => 'https://www.altierus.edu/',
            'https://www.alamo.edu/academics/programfinder/workforceprograms/industrialmaintenance_mechatronicstechnician/' => 'https://www.alamo.edu/academics/program-finder/Workforce-Programs/PLC-Programmer/',
            'http://alliedskills.info///programs.html' => 'https://alliedskills.info',

        ];

        foreach ($bad_to_good_map as $bad => $good) {
            $pos = strpos($url,$bad);
            if ($pos !== false) {
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

        $url = preg_replace("/^http:/i", "https:", $url);
        return strtolower($url);
        // change http:// to https://
//        if ((!(substr($url, 0, 7) == 'http://'))
//                &&
//            (!(substr($url, 0, 8) == 'https://'))
//        ) {
//            $new_url = 'https://' . $url;
//           // $this->command->info("Fixed $url to => $new_url");
//            return strtolower($new_url);
//        } else {
//            return strtolower($url);
//        }

    }



    public function slugify($str)
    {
        return Str::lower(Str::camel($str));
    }


}
