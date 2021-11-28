<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Show a paginated list of programs.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = Program::getUniquesFor('provider_campus_city');
        $counties = Program::getUniquesFor('provider_campus_county');

        $programs = Program::paginate(15);

        $num_documents = Program::count();


        return view('programs/all', [
            'num_documents' => $num_documents,
            'programs' => $programs,
            'cities' => $cities,
            'counties' => $counties,
            'pagetitle' => "List of WIOA Programs in Texass"
        ]);
    }

    /**
     * Display a dashboard for the home page.
     * The way I'm calculating some of the numbers could probably be done better with aggregates/mongodb
     * itself, but I don't know how to do that.. hopefully I can learn how to do the eloquent ORM way of
     * doing it soon.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $programs = Program::orderBy('program_start_date', 'desc')->paginate(15); #->orderBy('program_start_date','desc');
        $num_documents = Program::count();
        $cost = 0;
        $count_unique_providers = 0;
        $count_unique_cities = 0;
        $average_cost = 0;
        if($num_documents > 0 ) {
            

            $cities = Program::getUniquesFor('provider_campus_city');
            $counties = Program::getUniquesFor('provider_campus_county');
            $providers = Program::getUniquesFor('twc_provider_id');
            $average_cost = Program::getAverageCost(); 
            

        }


        return view('welcome', [
            'num_documents' => $num_documents,
            'cities' => $cities,
            'providers' => $providers,
            'counties' => $counties,
            'programs' => $programs,
            'average_cost' => $average_cost,
            'pagetitle' => "The Texas Workforce Commission WIOA Program List"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function edit(Program $program)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Program $program)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Program  $program
     * @return \Illuminate\Http\Response
     */
    public function destroy(Program $program)
    {
        //
    }
}
