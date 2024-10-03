<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Carbon\Carbon;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;
use Str;

class Details extends Component
{
    public function render(Request $request)
    {

        $program = Program::where('program_slug', $request->slug)->firstOrFail();
        // limit page title to 70 characters
        $pageTitle = $program->program_name.' '.
                ucwords($program->provider_campus_city).
            ',TX ('.$program->twc_program_id.')';

        //        echo Str::length($pageTitle) ;
        Meta::setTitle($pageTitle);
        Meta::setKeywords($program->program_name.', '.$program->provider_campus_city.
                ', '.$program->provider_campus_name
                .', '.$program->provider_campus_zip
        )
            ->setDescription($program->program_name.' classes in '.ucwords($program->provider_campus_city).' '.
            $program->provider_campus_state.' by '.$program->provider_name.' '.$program->provider_campus_name.
        ' ('.$program->twc_program_id.')');

        $local_twc_website = Program::getOfficeByCounty($program->provider_campus_county);
       
            $program->cost = $program->program_cost_tuition_and_fees;
       
        // Build the Schema.org stuff now
        $streetAddress = $program->provider_campus_addr1.' '.$program->provider_campus_addr2;
        // $sdPublishdate = strftime('%Y-%m-%d', (int) $program->program_last_updated);
$sdPublishdate = $program->program_last_updated;
        $program_description = trim($program->program_description);
        if (strlen(trim($program->program_description)) === 0) {
            $program_description = $program->program_name;
        } else {
            $program_description = trim($program->program_description);
        }

        $schema = Schema::course()
            ->name($program->program_name)
            ->description($program_description)
            ->provider(
                Schema::organization()
                    ->name($program->provider_name)
                    ->additionalType($program->provider_type)
                    ->address(
                        Schema::postalAddress()
                            ->streetAddress($streetAddress)
                            ->addressLocality($program->provider_campus_city)
                            ->addressCountry('USA')
                            ->addressRegion($program->provider_campus_state)

                    )
            )
            ->educationalCredentialAwarded($program->program_outcome)
            ->occupationalCredentialAwarded($program->program_credential_name)
            ->interactivityType($program->program_format)
            ->sdPublisher('Texas Workforce Commission')
            ->sdDatePublished($sdPublishdate)
            ->url($program->program_url);
            $schema->hasCourseInstance(
                Schema::courseInstance()
                    ->courseMode($program->program_format)
                    ->location($program->provider_campus_name)); 
        $schema->offers(
            Schema::offer()->price($program->cost)
                ->priceCurrency('USD')
                ->category('Training Program')
        );

        $og = new OpenGraphPackage('og');
        $og->setType('website')
            ->setSiteName('Texas Workforce Commission WIOA Eligible Training Provider and Program List')
            ->setTitle($program->program_name.
                ' class in '.$program->provider_campus_city.
                ', '.$program->provider_campus_state)
            ->setUrl(request()->url());
        // $og->addImage(env('APP_URL').'/images/texas.svg', [
        //     'type' => 'image/svg+xml',
        // ]
        // );

        // Build Open Graph Stuff
        Meta::registerPackage($og);

        $card = new TwitterCardPackage('twitter');
        $card->setType('summary')
            ->setSite('@vidluther')
            ->setDescription('More information on '.
                $program->program_name.
                ' class in '.ucwords($program->provider_campus_city).
                ', '.$program->provider_campus_state

            )
            ->setTitle(
                $program->program_name.
                ' class in '.ucwords($program->provider_campus_city).
                ', '.$program->provider_campus_state
            );

        Meta::registerPackage($card);

        // Actually render the page.

//         dd([
//     'start_date_raw' => $program->program_start_date,
//     'update_date_raw' => $program->program_last_updated,
// ]);

        $program_start_date = Carbon::createFromTimestamp($program->program_start_date);
        $record_update_date = $program->program_last_updated;

        // dd($program_start_date);
        return view('livewire.details', [
            'program_start_date' => $program_start_date,
            'record_update_date' => $record_update_date,
            'program_twist_id' => $request->program_twist_id,
            'program' => $program,
            'local_twc_website' => $local_twc_website,
            'schema' => $schema,
        ]
        );
    }
}
