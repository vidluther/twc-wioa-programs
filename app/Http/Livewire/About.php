<?php

namespace App\Http\Livewire;

use Butschster\Head\Facades\Meta;
use Livewire\Component;

class About extends Component
{
    public function render()
    {

        Meta::setTitle('About')
            ->prependTitle('TexasWFC.com ')
            ->setDescription('About the Texas Workforce Commission WIOA program');

        return view('livewire.about');
    }
}
