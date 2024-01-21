<?php

namespace App\Http\Livewire\Panel\Machines\Sequence;

use App\Models\Machines\Sequence;
use App\Models\Machines\Step;
use App\Models\Machines\StepSettings;
use Illuminate\Support\Carbon;
use Livewire\Component;
use WireUi\Traits\Actions;

class Show extends Component
{
    use Actions;
    
    public Sequence $sequence;
    
    protected $listeners = [
        'refreshSequence' => '$refresh',
    ];

    public function render()
    {
        $steps = Step::query()
            ->where('sequence_id', $this->sequence->id)
            ->orderBy('order')
            ->get();

        return view('livewire.panel.machines.sequence.show', [
            'steps' => $steps
        ]);
    }

    public function reorderSteps($stepIds)
    {
        $stepIds = array_filter($stepIds);

        $steps = Step::query()->findMany($stepIds)
            ->map(function (Step $step) use ($stepIds) {
                $step->order = array_flip($stepIds)[$step->id];

                return $step;
            });

            // dd($steps->toArray());
        Step::query()->upsert(
            $this->stepsToArray($steps),
            ['id'],
            ['order']
        );

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "Etapas ordenadas com sucesso!",
            'icon'        => 'success'
        ]);
    }

    public function stepsToArray($steps, $data = array())
    {
        foreach ($steps as $index => $step) {
            $data[$index] = $step->toArray();

            $data[$index]['created_at'] = Carbon::parse($step->created_at);
            $data[$index]['updated_at'] = Carbon::parse($step->updated_at);
        }

        return $data;
    }
}
