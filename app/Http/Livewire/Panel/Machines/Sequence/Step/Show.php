<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step;

use App\Models\Machines\Step;
use Livewire\Component;

class Show extends Component
{
    public Step $step;
    
    protected $listeners = [
        'refreshStep' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.panel.machines.sequence.step.show');
    }
}
