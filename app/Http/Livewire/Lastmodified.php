<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Program;


class Lastmodified extends Component
{
    public string $last_modified;
    public function render()
    {
        $latestRecord = Program::where('program_name', 'LIKE', '%')
                ->orderByDesc('updated_at')->first();

        $this->last_modified = $latestRecord->updated_at;


        return view('livewire.lastmodified');
    }
}
