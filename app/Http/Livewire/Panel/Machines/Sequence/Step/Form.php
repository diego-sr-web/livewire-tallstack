<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step;

use WireUi\Traits\Actions;
use App\Models\Machines\Step;
use App\Models\Machines\Sequence;
use Illuminate\Support\Facades\DB;
use App\Models\Machines\StepSettings;
use App\Models\Machines\StepLog;
use LivewireUI\Modal\ModalComponent;

class Form extends ModalComponent
{
    use Actions;

    public $name;
    public $description;
    public Sequence $sequence;
    public Step $step;

    protected $rules = [
        'name' => 'required|string',
    ];

    public function mount(Sequence $sequence, Step $step)
    {
        $this->sequence = $sequence;
        $this->step = $step;

        if (data_get($this->step, 'id')) {
            $this->name = $this->step->name;
            $this->description = $this->step->description;
        }

    }

    public function render()
    {
        return view('livewire.panel.machines.sequence.step.form');
    }

    public function save()
    {
        $this->validate();

        $log = [
            'rel_id' => user()->profile->relation->id,
            'rel_type' => user()->profile->relation::class,
        ];

        try {
            DB::beginTransaction();

            if (!data_get($this->step, 'id')) {
                $settings = StepSettings::create([
                    'condition' => '',
                ]);

                $step = $this->sequence->steps()->create([
                    'step_settings_id' => $settings->id,
                    'name' => $this->name,
                    'description' => $this->description,
                ]);

                $log['log'] = json_encode($this->prepareToArray($step->toArray()));

                $step->order = $step->id;
                $step->save();

                $log['step_id'] = $step->id;

                $message = "Criada com sucesso!";

            } else {
                $log['step_id'] = $this->step->id;
                $log['action'] = 'U';
                $log['log'] = json_encode($this->prepareToArray($this->step->toArray()));

                $this->step->update([
                    'name' => $this->name,
                    'description' => $this->description,
                ]);

                $message = "Atualizada com sucesso!";
            }

            StepLog::create($log);

            DB::commit();

            $this->emit('refreshSequence');

            $this->notification([
                'title'       => 'Sucesso!',
                'description' => $message,
                'icon'        => 'success'
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
dd($e);
            $this->notification([
                'title'       => 'Erro!',
                'description' => "Erro ao tentar criar ou atualizar etapa!",
                'icon'        => 'error'
            ]);
        }

        $this->closeModal();
    }

    public function prepareToArray($data)
    {
        if (array_key_exists('id', $data))
            unset($data['id']);

        if (array_key_exists('created_at', $data))
            unset($data['created_at']);

        if (array_key_exists('updated_at', $data))
            unset($data['updated_at']);

        if (array_key_exists('sequence_id', $data))
            unset($data['sequence_id']);

        if (array_key_exists('step_settings_id', $data))
            unset($data['step_settings_id']);

        if (array_key_exists('leads_reached', $data))
            unset($data['leads_reached']);

        if (array_key_exists('open', $data))
            unset($data['open']);

        if (array_key_exists('clicks', $data))
            unset($data['clicks']);

        if (array_key_exists('step_id', $data))
            unset($data['step_id']);

        return $data;
    }
}
