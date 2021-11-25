<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programs = Program::all();
        $num_documents = Program::count();

        return view('programs/all', [
            'num_documents' => $num_documents,
            'programs' => $programs
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
        $programs = Program::all();
        $num_documents = Program::count();
        $cost = 0;
        $count_unique_providers = 0;
        $count_unique_cities = 0;
        $average_cost = 0;
        if($num_documents > 0 ) {
            foreach($programs AS $program) {
                $cost = $cost + (int) $program->program_cost_tuition_and_fees;
                $twc_ids[] = $program->twc_provider_id;
                $citys[] = $program->provider_campus_city;
            }
            $count_unique_cities = count(array_unique($citys));
            $count_unique_providers = count(array_unique($twc_ids));

            $average = $cost / $num_documents;

            $average_cost = number_format($average, '2');

        }


        return view('welcome', [
            'num_documents' => $num_documents,
            'count_unique_cities' => $count_unique_cities,
            'count_unique_providers' => $count_unique_providers,
            'programs' => $programs,
            'average_cost' => $average_cost
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
