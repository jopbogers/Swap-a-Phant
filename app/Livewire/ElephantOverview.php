<?php

namespace App\Livewire;

use App\Models\Elephant;
use Livewire\Component;

class ElephantOverview extends Component
{
    public $search = '';

    public function render()
    {
        return view(
            'livewire.elephant-overview',
            ['elephants' => Elephant::where('name', 'LIKE', '%'.$this->search.'%')->get()]
        );
    }
}
