<?php

namespace App\Http\Livewire\Panel\Machines\Sequence;

use App\Models\Machines\Machine;
use LivewireUI\Modal\ModalComponent;

class Logs extends ModalComponent
{
    public Machine $machine;

    public function mount(Machine $machine)
    {
        $this->machine = $machine;
    }

    public function render()
    {
        return view('livewire.panel.machines.machine.logs');
    }

    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }
}
