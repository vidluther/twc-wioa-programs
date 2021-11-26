<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HelloWorld extends Component
{
    public $name = "Wiry"; 
    public function render()
    {
        return view('livewire.hello-world', [
            'name' => "Wiry"
        ]
    );
    }
}
