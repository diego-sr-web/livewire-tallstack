<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step;

use Livewire\Component;
use WireUi\Traits\Actions;
use App\Models\Machines\Step;
use App\Models\Machines\StepLog;

class Dropdown extends Component
{
    use Actions;

    public Step $step;

    protected $listeners = [
        'refreshDropdown' => '$refresh',
    ];
    
    public function mount(Step $step): void
    {
        $this->step = $step;
    }

    public function render()
    {        
        return view('livewire.panel.machines.sequence.step.dropdown');
    }

    private function setLog(Step $step, string $action, $log = null): void
    {
        StepLog::create([
            'rel_id' => user()->profile->relation->id,
            'rel_type' => user()->profile->relation::class,
            'step_id' => $step->id,
            'action' => $action,
            'log' => json_encode($log)
        ]);
    }
}
