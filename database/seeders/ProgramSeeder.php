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
        #dd($header);
        $provider_url = null;
        foreach($csv AS $offset => $line) {

            // sanitize provider_url
            $provider_url = $this->fixUrl(trim($line['Provider URL']));
            $program_url = $this->fixUrl(trim($line['Program URL']));

            $program_twist_id = null;
            $provider_twist_id = null;

            if(trim($line['TWIST Program ID']) === '') {
                $program_twist_id = rand(200000,299999);
                $this->command->error("Program id was blank at line $offset, I changed it to $program_twist_id " . $line['Provider Name']);
            } else {
                $program_twist_id = trim($line['TWIST Program ID']);
            }

            if(trim($line['TWIST Provider ID']) === '') {

                $provider_twist_id = rand(300000,399999);
                $this->command->error("Provider id was blank at line $offset, I changed it to $provider_twist_id " . $line['Provider Name']);
            } else {
                $provider_twist_id = trim($line['TWIST Provider ID']);
            }

            Program::create([
                'twc_provider_id' => $line['Provider #'],
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
                'outofdistrict_tuition_and_fees' => trim($line[" (Out Of District)\nCost: \nTuition & Fees "]),
                'program_total_apprentices' => $line['Number Of Apprentices'],
                'program_start_date' => strtotime($line['Program Start Date']),
                'program_last_updated' => strtotime($line['Program Last Update Date'])



            ]) ;

            # Go check and see if the Database already has a provider with this number.
        }


    }

    public function fixUrl($url)
    {
        // If the start of the string doesn't have http or https, add it.

        if ((!(substr($url, 0, 7) == 'http://')) && (!(substr($url, 0, 8) == 'https://'))) {
            $url = 'https://' . $url;
        }

        return $url;
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
