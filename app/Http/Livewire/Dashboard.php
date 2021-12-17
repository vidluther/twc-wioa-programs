<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Butschster\Head\Facades\Meta;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;

class Dashboard extends Component
{
    use WithPerPagePagination;
    public ?string $search = null;
    public ?string $search_city = null;


    public function render(Request $request)
    {

        $cities = Program::getUniquesFor('provider_campus_city');

        $programs = Program::search('program_name', $this->search)->paginate(30);

        Meta::setDescription("WIOA eligible providers and classes that teach " . $this->search . " in Texas")
            ->setTitle("WIOA Eligible Providers that teach " . $this->search . " classes in Texas");


//        if(is_null($this->search)) {
////            dd("search is null");
//            $programs = Program::orderBy('provider_campus_city', 'asc')->paginate(20);
//        }
//
//        if(strlen($this->search) === 0) {
//           // dd("strlen is 0");
//            $programs = Program::orderBy('provider_campus_city', 'asc')->paginate(20);
//        }
//
//        if(!is_null($this->search)) {
//
//            $programs = Program::where('program_name', 'LIKE', '%'.$this->search.'%')
//                    ->paginate(20);
//        }



        return view('livewire.dashboard', [
            'cities' => $cities,
            'programs' => $programs
        ]);
    }
}
