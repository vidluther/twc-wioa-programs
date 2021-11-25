<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use League\Csv\Reader;
use League\Csv\Statement;
use App\Models\Program;
use Illuminate\Support\Str;

class CsvSeeder extends Seeder
{
    /**
     * This will import all records from the CSV that qualify as Provider
     *
     * @return void
     */
    public function run()
    {
        $csv = Reader::createFromPath('./storage/twc-file.csv', 'r');
        $csv->setHeaderOffset(0);
        $header_offset = $csv->getHeaderOffset(); //returns 0
        $header = $csv->getHeader();
        echo count($csv) . " records found" . PHP_EOL;
        #dd($header);
        foreach($csv AS $offset => $line) {
           //dd($line);

            Program::create([
                'twc_provider_id' => $line['Provider #'],
                'provider_name' => $line['Provider Name'],
                'provider_url' => strtolower($line['Provider URL']),
                'provider_description' => $line['Description Of Provider'],
                'provider_type' => $line['Institution Type'],
                'provider_campus_name' => $line['Campus Name'],
                'provider_campus_addr1' => $line['Campus Address1'],
                'provider_campus_addr2' => $line['Campus Address2'],
                'provider_campus_city' => $line['Campus City'],
                'provider_campus_state' => $line['Campus State'],
                'provider_campus_zip' => $line['Campus Zip Code'],
                'provider_campus_county' => $line['Campus County'],

                'public_transit' => $line["Information:\nPublic Transit?"],
                'onsite_childcare' => $line["Information:\nOnsite Childcare?"],
                'flexible_hours' => $line["Information:\nFlexible Hours?"],

                'program_name' => $line['Program Name'],
                'program_description' => $line['Program Description'],
                'program_pell_eligible' => $line['Pell Eligible'],
                'program_pre_reqs' => $line['Academic PreRequisites'],
                'program_url' => strtolower($line['Program URL']),
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
                'program_start_date' => $line['Program Start Date'],
                'program_last_updated' => $line['Program Last Update Date']



            ]) ;

            # Go check and see if the Database already has a provider with this number.
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
