<?php

namespace App\Http\Livewire\Panel\Machines\Machine;

use App\Actions;
use Livewire\Component;
use App\Models\Machines\Step;
use App\Jobs\StepSendEmailJob;
use App\Models\Machines\Sequence;
use App\Models\Machines\Machine as ModelMachine;
use Illuminate\Notifications\Action;

class Index extends Component
{
    public bool $status = false;
    public ?string $search = '';

    protected $listeners = [
        'refreshMachines' => '$refresh',
        'startStopMachine'
    ];

    public function render()
    {
        return view('livewire.panel.machines.machine.index', [
            'machines' => $this->getMachines(),
            'status' => $this->status
        ]);
    }

    private function getMachines()
    {
        $query = ModelMachine::query()
            ->where('company_id', companyId())
            ->where('status', '<', 99)
            ->when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
            });

        return $query->get();
    }

    public function startStopMachine(ModelMachine $machine): void
    {
        switch ($machine->status) {
            case 0: 
                $this->runJobsSequences($machine);
                break;
            case 1:
                $this->runJobsSequences($machine);
                break;                
        }
    }

    private function runJobsSequences(ModelMachine $machine): void
    {
        $sequences = Sequence::query()
            ->where('machine_id', $machine->id)
            ->where('active', 1)
            ->orderBy('order', 'ASC')
            ->get()
            ;

        if ($sequences->count()) {
            $sequences->each(function (Sequence $sequence) {
                $steps = Step::query()
                    ->where('sequence_id', $sequence->id)
                    ->where('active', 1)
                    ->orderBy('order', 'ASC')
                    ->get()
                    ;

                $steps->each(function (Step $step) {
                    Actions\Machines\StepQueue::run($step);
                });
            });
        }
    }
}
