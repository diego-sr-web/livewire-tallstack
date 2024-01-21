<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step;

use App\Models\Machines\Step;
use LivewireUI\Modal\ModalComponent;

class Logs extends ModalComponent
{
    public Step $step;

    public function mount(Step $step)
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.panel.machines.sequence.step.logs');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
