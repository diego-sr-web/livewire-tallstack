<?php

namespace App\Http\Livewire\Panel\Machines\Sequence;

use App\Models\Machines\Sequence;
use App\Models\Machines\SequenceLog;
use Livewire\Component;
use WireUi\Traits\Actions;

class Dropdown extends Component
{
    use Actions;

    public Sequence $sequence;

    protected $listeners = [
        'refreshDropdown' => '$refresh',
    ];
    
    public function mount(Sequence $sequence): void
    {
        $this->sequence = $sequence;
    }

    public function render()
    {        
        return view('livewire.panel.machines.sequence.dropdown');
    }

    public function play(Sequence $sequence): void
    {
        $log = $this->prepareToArray($sequence->toArray());

        $sequence->status = 1;        
        $sequence->save();

        $this->setLog($sequence, 'S', $log);

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "A máquina de vendas {$sequence->name} foi iniciada com sucesso!",
            'icon'        => 'success'
        ]);

        $this->emitUp('refreshSequences');
    }

    public function pause(Sequence $sequence): void
    {
        $log = $this->prepareToArray($sequence->toArray());

        $sequence->status = 0;
        $sequence->save();

        $this->setLog($sequence, 'P', $log);

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "A máquina de vendas {$sequence->name} foi pausada com sucesso!",
            'icon'        => 'success'
        ]);

        $this->emitUp('refreshSequences');
    }

    public function confirmDelete(Sequence $sequence): void
    {
        $this->dialog()->confirm([
            'title'       => 'Você tem certeza?',
            'description' => "Quer realmente excluir a maquina {$sequence->name}?",
            'acceptLabel' => 'Sim, eu quero',
            'method'      => 'delete',
            'params'      => $sequence,
        ]);
    }

    public function delete(Sequence $sequence): void
    {        
        $log = $this->prepareToArray($sequence->toArray());

        $this->setLog($sequence, 'D', $log);

        $sequence->status = 99;
        $sequence->save();

        $this->dialog()->success(
            $title = 'Excluída',
            $description = "A máquina de vendas {$sequence->name} foi excluída com sucesso!",
        );

        $this->emit('refreshSequences');
    }

    private function setLog(Sequence $sequence, string $action, $log = null): void
    {
        SequenceLog::create([
            'rel_id' => user()->profile->relation->id,
            'rel_type' => user()->profile->relation::class,
            'sequence_id' => $sequence->id,
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
