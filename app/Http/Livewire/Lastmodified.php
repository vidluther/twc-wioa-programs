<?php

namespace App\Http\Livewire;

use App\Models\Program;
use Carbon\Carbon;
use Livewire\Component;

class Lastmodified extends Component
{
    public string $last_modified;

    public function render()
    {
        $latestRecord = Program::where('program_name', 'LIKE', '%')
            ->orderByDesc('program_last_updated')->first();

        $this->last_modified = Carbon::createFromTimestamp($latestRecord->program_last_updated);
        //  $this->last_modified = date_format($latestRecord->updated_at, 'l, F d Y h:i:s T');

        //dd($this->last_modified);
        return view('livewire.lastmodified');
    }
}
