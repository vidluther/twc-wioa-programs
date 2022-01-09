<span class="prose">
<h3 class="py-6 font-semibold text-gray-700"> How to Apply for {{ $program->program_name }} class in {{ ucfirst($program->provider_campus_city) }}, TX </h3>
   If you're interested in signing up or learning more about this class, the next program start date is {{ date_format($program_start_date,'l, F d Y h:i:s T') }}

    <ol>
    <li> Apply for the program at <a class="underline" href="{{ $program->program_url }}"> {{ $program->provider_name }}</a> website. <br /></li>
    <li> Visit the <a class="underline" href="{{ $local_twc_website }}" target="new"> your local Workforce Solutions board office </a> and tell them you have
enrolled in the program. </li>
    <li> They will ask you a bunch of questions to see if you're eligible for financial assistance.  </li>
    </ol>

    </span>
<span clas="px-4 py-4"> </span>

