<?php

namespace App\Http\Livewire\Panel\Machines\Machine;

use App\Models\Machines\Machine;
use App\Models\Machines\MachineLog;
use Livewire\Component;
use WireUi\Traits\Actions;

class Dropdown extends Component
{
    use Actions;

    public Machine $machine;

    protected $listeners = [
        'refreshDropdown' => '$refresh',
    ];
    
    public function mount(Machine $machine): void
    {
        $this->machine = $machine;
    }

    public function render()
    {        
        return view('livewire.panel.machines.machine.dropdown');
    }

    public function play(Machine $machine): void
    {
        $log = $this->prepareToArray($machine->toArray());

        $machine->status = 1;        
        $machine->save();

        $this->setLog($machine, 'S', $log);

        $this->emit('startStopMachine', $machine);

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "A máquina de vendas {$machine->name} foi iniciada com sucesso!",
            'icon'        => 'success'
        ]);

        $this->emitUp('refreshMachines');
    }

    public function pause(Machine $machine): void
    {
        $log = $this->prepareToArray($machine->toArray());

        $machine->status = 0;
        $machine->save();

        $this->setLog($machine, 'P', $log);

        $this->emit('startStopMachine', $machine);

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "A máquina de vendas {$machine->name} foi pausada com sucesso!",
            'icon'        => 'success'
        ]);

        $this->emitUp('refreshMachines');
    }

    public function confirmDelete(Machine $machine): void
    {
        $this->dialog()->confirm([
            'title'       => 'Você tem certeza?',
            'description' => "Quer realmente excluir a maquina {$machine->name}?",
            'acceptLabel' => 'Sim, eu quero',
            'method'      => 'delete',
            'params'      => $machine,
        ]);
    }

    public function delete(Machine $machine): void
    {        
        $log = $this->prepareToArray($machine->toArray());

        $this->setLog($machine, 'D', $log);

        $machine->status = 99;
        $machine->save();

        $this->dialog()->success(
            $title = 'Excluída',
            $description = "A máquina de vendas {$machine->name} foi excluída com sucesso!",
        );

        $this->emit('refreshMachines');
    }

    private function setLog(Machine $machine, string $action, $log = null): void
    {
        MachineLog::create([
            'rel_id' => user()->profile->relation->id,
            'rel_type' => user()->profile->relation::class,
            'machine_id' => $machine->id,
            'action' => $action,
            'log' => json_encode($log)
        ]);
    }

    public function prepareToArray($data)
    {
        if (array_key_exists('file', $data))
            unset($data['file']);
        
        if (array_key_exists('created_at', $data))
            unset($data['created_at']);
        
        if (array_key_exists('updated_at', $data))
            unset($data['updated_at']);
        
        if (array_key_exists('description', $data))
            unset($data['description']);
        
        if (array_key_exists('slug', $data))
            unset($data['slug']);
        
        if (array_key_exists('company_id', $data))
            unset($data['company_id']);

        return $data;
    }
}
