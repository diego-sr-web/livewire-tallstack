<?php

namespace App\Http\Livewire\Panel\Machines\Sequence;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Machines\Machine;
use App\Models\Machines\Sequence;
use WireUi\Traits\Actions;

class Index extends Component
{
    use Actions;

    public bool $status = false;
    public ?string $search = '';
    public Machine $machine;

    protected $listeners = [
        'refreshSequences' => '$refresh',
    ];

    public function mount(Machine $machine = null)
    {
        if (data_get($machine, 'id')) {
            $this->machine = $machine;
        }
    }

    public function render()
    {        
        return view('livewire.panel.machines.sequence.index', [
            'sequences' => $this->getSequences(),
            'status' => $this->status
        ]);
    }

    private function getSequences()
    {
        $query = Sequence::query()
            ->where('machine_id', $this->machine->id)
            ->where('status', '<', 99)
            ->when($this->search, function ($query) {
                $query->where('name', 'LIKE', '%' . $this->search . '%');
            })
            ->orderBy('order', 'ASC');

        return $query->get();
    }

    public function reorderSequence($sequenceIds)
    {
        $sequenceIds = array_filter($sequenceIds);

        $sequences = Sequence::query()->findMany($sequenceIds)
            ->map(function (Sequence $sequence) use ($sequenceIds) {
                $sequence->order = array_flip($sequenceIds)[$sequence->id];

                return $sequence;
            });

            // dd($sequences->toArray());
        Sequence::query()->upsert(
            $this->sequencesToArray($sequences),
            ['id'],
            ['order']
        );

        $this->notification([
            'title'       => 'Sucesso!',
            'description' => "Etapas ordenadas com sucesso!",
            'icon'        => 'success'
        ]);

        $this->emitSelf('refreshSequences');
    }

    public function sequencesToArray($sequences, $data = array())
    {
        foreach ($sequences as $index => $sequence) {
            $data[$index] = $sequence->toArray();

            $data[$index]['created_at'] = Carbon::parse($sequence->created_at);
            $data[$index]['updated_at'] = Carbon::parse($sequence->updated_at);
        }

        return $data;
    }
}
