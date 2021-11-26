<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Livewire\Component;


class Course extends Component
{
    public $search;
    public function render()
    {
        return view('livewire.course');
    }
}
