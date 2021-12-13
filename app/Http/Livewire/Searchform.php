<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Searchform extends Component
{
    public string $searched_for;
    public function render()
    {
        $cities = '';
        return view('livewire.searchform');
    }
}
