<span class="prose">


     <div class="sticky top-0 p-4 bg-gray-100 rounded-xl w-full">
           <p class="space-y-2 px-1 py-1 ">
    You should check out this <a class="underline" href="https://www.workforcesolutionscb.org/job-seekers/targeted-occupations/"> Targeted Occupations List </a> to see how hot the market is
        for this skill, and how much you may get paid for a job in this field.
         </p>
     </div>
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
