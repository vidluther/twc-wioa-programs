<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use League\Csv\Reader;

//use GuzzleHttp\Exception\ClientException;

class ProgramSeeder extends Seeder
{
    private int $numBadUrls = 0;

    /**
     * @throws \League\Csv\Exception
     */
    public function run()
    {
        $csv = Reader::createFromPath('./storage/twc-file.csv', 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset(); //returns 0
        $header = $csv->getHeader();
        $this->command->info(count($csv).' records found');
        //dd($header);
        $provider_url = null;
        $counter = 1;
        foreach ($csv as $offset => $line) {

            // sanitize provider_url
            //$provider_url = $this->fixUrl(strtolower(trim($line['Provider URL'])),$line['Program Name']);

            // Sanitize Program URL
            $program_url = $this->fixUrl(strtolower(trim($line['Program URL'])), $line['Program Name']);

            // $this->checkUrl($program_url,$line['Program Name'],);
            $program_twist_id = null;
            $provider_twist_id = null;

            $program_twist_id = trim($line['TWIST Program ID']);
            $provider_twist_id = trim($line['TWIST Provider ID']);

            Program::create([
                'twc_provider_id' => $line['Provider ID'],
                'twc_program_id' => $line['Program ID'],
                'twc_program_status' => $line['Program Status'],

                'provider_name' => $line['ProviderName'],
                //    'provider_url' => mb_strtolower($provider_url),
                'provider_description' => $line['Provider Description'],
                'provider_type' => $line['Institution Type'],
                'provider_campus_name' => $line['Campus Name'],
                'provider_campus_addr1' => $line[' Campus Address '],
                'provider_campus_addr2' => $line['Campus Address 2'],
                'provider_campus_city' => mb_strtolower($line[' Campus City ']),

                'provider_campus_state' => $line['Campus State'],
                'provider_campus_zip' => $line[' Campus Zip Code '],
                'provider_campus_county' => mb_strtolower($line['Campus County']),

                'provider_twist_id' => $provider_twist_id,
                'program_twist_id' => $program_twist_id,

                'public_transit' => $line['Information: Public Transit'],
                'onsite_childcare' => $line['Information: Onsite Childcare'],
                'flexible_hours' => $line['Information: Flexible Hours'],

                'program_name' => $line['Program Name'],
                'program_description' => $line['Program Description'],
                'program_pell_eligible' => $line['Pell Eligible'],
                'program_pre_reqs' => $line['Academic PreRequisites'],
                'program_url' => mb_strtolower($program_url),
                'program_outcome' => $line['Program Outcome'],
                'program_credential_name' => $line['Associted Credential Name'],
                'program_length_hours' => $line['Length: Contact Hours'],
                'program_length_weeks' => $line['Length: Weeks'],
                'program_format' => $line['Delivery Method'],
                'program_occupation_code1' => $line['Occupation Code (ONET 1)'],
                'program_occupation_code2' => $line['Occupation Code (ONET 2)'],
                'program_occupation_code3' => $line['Occupation Code (ONET 1)'],
                'program_cost_tuition_and_fees' => trim($line[' Required Cost: Tuition & Fees ']),
                'program_cost_books_and_supplies' => trim($line[' Required Cost: Books & Supplies ']),
                'program_cost_other' => trim($line[' Optional Cost ']),
                //                'outofdistrict_tuition_and_fees' => $line[" (Out Of District)\n
                //Cost: \n
                //Tuition & Fees\n"],
                'program_total_apprentices' => $line['Number Of Apprentices'],
                'program_start_date' => strtotime($line['Program ETPL Start Date']),
                'program_last_updated' => strtotime($line['Program ETPL Last Update']),

                'city_slug' => Str::slug($line[' Campus City '], '-'),

            ]);
            //$this->command->info($counter);
            $counter++;
        }

    }

    public function fixUrl($url, $program_name)
    {
        // If the url is blank.. change it to example.com for now.. and return it.
        if (strlen($url) === 0) {
            //$this->command->error('Got a blank url .. returning https://www.example.com/');
            return 'https://www.example.com/';
        }

        $has_search_url_map = [
            'alamo.edu' => 'https://www.alamo.edu/search/?q=',
            'alvincollege' => 'https://www.alvincollege.edu/search/?q=',
            'asher.edu' => 'https://asher.edu/?s=',
            'actx.edu' => 'https://www.actx.edu/searchac/search.html?q=',
            'collin.edu' => 'https://www.collin.edu/search.html?q=',
            'computerminds.com' => 'https://computerminds.com/?s=',
            'grayson.edu' => 'https://catalog.grayson.edu/2021-2022/search.php?q=',
            'blinn.edu' => 'https://www.blinn.edu/?ss360Query=',
            'templejc.edu' => 'https://www.templejc.edu/search/?q=',
            'apprenticareers' => 'https://apprenticareers.org/?s=',
            'austincc.edu' => 'https://www.austincc.edu/search?search=',
            'midland.edu' => 'https://www.midland.edu/search.php?q=',
            'odessa.edu' => 'https://www.google.com/search?sitesearch=www.odessa.edu&q=',
            'tstc.edu' => 'https://www.tstc.edu/?s=',
            'hccs.edu' => 'https://www.hccs.edu/search-results/?q=',
            'wcjc.edu' => 'https://www.wcjc.edu/Search_Results.aspx?q=',
            'sanjac.edu' => 'https://www.sanjac.edu/search?combine=',
            'swjtc.edu' => 'https://swtjc.edu:8443/dir/qsearch3.jsp?qsearch=',
            'tjc.edu' => 'https://www.tjc.edu/site/scripts/google_results.php?q=',
            'catalog.southtexascollege.edu' => 'https://catalog.southtexascollege.edu/search/?search=',
            'gc.edu' => 'https://gc.edu/?s=',
            'nctc.edu' => 'https://www.nctc.edu/search-test?q=',
            'rangercollege.edu' => 'https://www.rangercollege.edu/?s=',
            'uiw.edu' => 'https://search.uiw.edu/s/search.html?collection=uiw-search&query=',
            'texarkanacollege.edu' => 'https://www.texarkanacollege.edu/zoomsearch/?zoom_query=',
            'com.edu' => 'https://www.com.edu/search/?ousearchq=',

        ];

        foreach ($has_search_url_map as $badstring => $search_url) {
            $pos = strpos($url, $badstring);
            if ($pos !== false) {
                $this->numBadUrls++;

                // $this->command->info($this->numBadUrls . " found $badstring converted to $search_url");
                return $search_url.rawurlencode($program_name);
            }
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
            'www.lsco.edu' => 'https://www.lsco.edu',
            'lamar state college orange' => 'https://www.lsco.edu',
            'rangercollege.edu/truck-driving' => 'https://www.rangercollege.edu/',
            'rangercollege.edu/emt' => 'https://www.rangercollege.edu/emt/',
            'dni.edu' => 'https://www.thechicagoschool.edu',
            'www.consultingsolutions.net' => 'https://www.twc.texas.gov',
            'austin.cc.tx.us' => 'https://www.austincc.edu/',
            'ntxapics.org' => 'https://www.ascm.org/learning-development/',
            'https:www.angelo.edu' => 'https://www.angelo.edu/',
            'absolutecprdallas.com' => 'https://absolutecprdallas.com/',
            'nctc.edu' => 'https://www.nctc.edu/',
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
            'https://www.texarkanacollege.edu/study/associatedegreenursing/' => 'https://www.texarkanacollege.edu/study/associate-degree-nursing/adn-basic-program/',
            'http://www.austincareerinstitute.com/index2.html' => 'https://www.austincareerinstitute.edu/',
            'nationaldentalservices.com' => 'https://national-dental-services.com/nds-dental-assisting-school',
            'http:www.lonestar.edu' => 'https://www.lonestar.edu',
            'https:www1.dcccd.edu' => 'https://www1.dcccd.edu',
            'gatewaytc.net' => 'https://www.gatewaytechnicalschool.com',
            'dynamicadvancement.com' => 'https://www.dynamicadvancement.com',
            'navarrocollege' => 'https://www.navarro.edu',
            'http:www.northharriscollege.com' => 'https://www.lonestar.edu/northharris',
            'wc.edu' => 'https://wc.edu',

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
            $pos = strpos($url, $bad);
            if ($pos !== false) {
                return $good;
            }
        }

        // just check for malformed strings..

        if (substr($url, 0, 8) == 'http:www') {
            // $this->command->error('Need to fix ' . $url);
            $new_url = str_replace('http:www', 'https://www', $url);

            // $this->command->info("Changed $url to: $new_url");
            return strtolower($new_url);
        }

        // change http:// to https://
        if ((! (substr($url, 0, 7) == 'http://'))
                &&
            (! (substr($url, 0, 8) == 'https://'))
        ) {
            $new_url = 'https://'.$url;

            // $this->command->info("Fixed $url to => $new_url");
            return strtolower($new_url);
        } else {
            $url = preg_replace('/^http:/i', 'https:', $url);

            //$this->command->info("Returning $url ");
            return strtolower($url);
        }

        // replace http with https

        //return strtolower($url);

    }

    public function slugify($str)
    {
        return Str::lower(Str::camel($str));
    }
}
