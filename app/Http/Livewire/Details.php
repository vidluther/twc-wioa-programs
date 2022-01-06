<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Butschster\Head\Packages\Entities\TwitterCardPackage;
use Livewire\Component;
use Spatie\SchemaOrg\Schema;
use Illuminate\Http\Request;

class Details extends Component
{
    public function render(Request $request)
    {


        $program = Program::where('twc_program_id', $request->twc_program_id)->firstOrFail();


        Meta::setTitle($program->program_name . " class in " . ucwords($program->provider_campus_city) . ", "
            . $program->provider_campus_state . ' (' . $program->twc_program_id . ')')
            ->setKeywords($program->program_name. ', '.  $program->provider_campus_city .
                ', '. $program->provider_campus_name
                .', ' . $program->provider_campus_zip
            )
            ->setDescription($program->program_name . " classes in " . ucwords($program->provider_campus_city) . " ".
                $program->provider_campus_state . " by " . $program->provider_name . ' ' . $program->provider_campus_name .
            ' ('. $program->twc_program_id . ')');

        $local_twc_website = Program::getOfficeByCounty($program->provider_campus_county);

        if(is_numeric($program->program_cost_tuition_and_fees)) {
            $program->cost = '$' . number_format($program->program_cost_tuition_and_fees, 2);
        } else {
            $program->cost = 'unknown';
        }

        // Build the Schema.org stuff now
        $streetAddress = $program->provider_campus_addr1 . ' ' . $program->provider_campus_addr2 ;
        $sdPublishdate = strftime("%Y-%m-%d", (int) $program->program_last_updated);

        $program_description = trim($program->program_description);
        if(strlen(trim($program->program_description)) === 0) {
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


        $schema->offers(
            Schema::offer()->price($program->cost)
                ->priceCurrency('USD')
        );

        $og = new OpenGraphPackage('og');
        $og->setType('website')
            ->setSiteName('Texas Workforce Commission WIOA Eligible Training Provider and Program List')
            ->setTitle($program->program_name .
                ' class in ' . $program->provider_campus_city .
                ', ' . $program->provider_campus_state)
            ->setUrl(request()->url());
        $og->addImage(env('APP_URL') . '/images/texas.svg',[
                'type' => 'image/svg+xml'
            ]
        );

        // Build Open Graph Stuff
        Meta::registerPackage($og);


        $card = new TwitterCardPackage('twitter');
        $card->setType('summary')
            ->setSite('@vidluther')
            ->setImage(env('APP_URL') . '/images/texas.svg')
            ->setDescription("More information on".
                $program->program_name .
                ' class in ' . $program->provider_campus_city .
                ', ' . $program->provider_campus_state

            )
            ->setTitle(
                $program->program_name .
                ' class in ' . $program->provider_campus_city .
                ', ' . $program->provider_campus_state
            );


        Meta::registerPackage($card);

        // Actually render the page.

        return view('livewire.details', [
                'program_twist_id' => $request->program_twist_id,
                'program' => $program,
                'local_twc_website' => $local_twc_website,
                'schema' => $schema
            ]
        );
    }
}
