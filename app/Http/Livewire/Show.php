<?php

namespace App\Http\Livewire;

use Butschster\Head\Facades\Meta;
use Butschster\Head\Packages\Entities\OpenGraphPackage;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Program;
use Spatie\SchemaOrg\Schema;


class Show extends Component
{
    public string $schema;
    public function render(Request $request)
    {
        $program = Program::where('program_twist_id', $request->program_twist_id)->firstOrFail();

        Meta::setTitle($program->program_name . " class in " . $program->provider_campus_city . " " . $program->provider_campus_state)
            ->prependTitle('')
            ->setKeywords($program->program_name. ', '.  $program->provider_campus_city .
                ', '. $program->provider_campus_state
                .', ' . $program->provider_campus_zip
            )
            ->setDescription($program->program_description . " classes in " . $program->provider_campus_city . " ".
            $program->provider_campus_state . " by " . $program->provider_name);

        $local_twc_website = Program::getOfficeByCounty($program->provider_campus_county);

        if(is_numeric($program->program_cost_tuition_and_fees)) {
            $program->cost = '$' . number_format($program->program_cost_tuition_and_fees, 2);
        } else {
            $program->cost = 'unknown';
        }

        // Build the Schema.org stuff now
        $streetAddress = $program->provider_campus_addr1 . ' ' . $program->provider_campus_addr2 ;
        $sdPublishdate = strftime("%Y-%m-%d", (int) $program->program_last_updated);
        $schema = Schema::course()
            ->name($program->program_name)
                ->description($program->program_description)
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

        Meta::registerPackage($og);
        return view('livewire.show', [
                'program_twist_id' => $request->program_twist_id,
                'program' => $program,
                'local_twc_website' => $local_twc_website,
                'schema' => $schema
            ]
        );
    }
}
