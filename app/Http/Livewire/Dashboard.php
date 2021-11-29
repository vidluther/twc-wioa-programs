<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Butschster\Head\Facades\Meta;
use App\Models\Program;

class Dashboard extends Component
{
    public $pagetitle;
    protected $programs;

    public function render()
    {
        Meta::setTitle('TexasWFC')
            ->prependTitle('Dashboard');

        $programs = Program::paginate(15);

        return view('livewire.dashboard');

    }
}
