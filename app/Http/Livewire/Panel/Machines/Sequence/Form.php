<?php

namespace App\Http\Livewire\Panel\Machines\Sequence;

use App\Models\Machines\Machine;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Form extends ModalComponent
{
    use Actions;

    public $name;
    public Machine $machine;

    protected $rules = [
        'name' => 'required|string',
    ];

    public function mount(Machine $machine)
    {
        $this->machine = $machine;
    }

    public function render()
    {
        return view('livewire.panel.machines.sequence.form');
    }

    public function save()
    {
        $this->validate();

        $this->machine->sequences()->create([
            'name' => $this->name,
        ]);

        $this->emit('refreshSequences');

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "Criada com sucesso!",
            'icon'        => 'success'
        ]);

        $this->closeModal();
    }
}
