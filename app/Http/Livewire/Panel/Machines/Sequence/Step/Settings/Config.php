<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step\Settings;

use App\Models\Machines\Machine;
use App\Models\Machines\Step;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use WireUi\Traits\Actions;

class Config extends Component
{
    use Actions;

    public Step $step;
    public int $totalLine = 1;
    public int $startLine = 0;

    public array $destination = [];
    public array $name = [];
    public array $expected_name = [];
    public array $condition = [];
    public array $api = [];

    public $settings;

    public function mount() 
    {
        $this->settings = json_decode($this->step->settings->condition);
        
        if (count($this->settings)) {
            $this->totalLine = count($this->settings);
            $this->startLine = count($this->settings);
        }

        $this->mountSettings();        
    }

    public function render()
    {
        return view('livewire.panel.machines.sequence.step.settings.config', [
            'destinations' => $this->getDestinations(),
            'settings' => $this->settings
        ]);
    }

    private function mountSettings()
    {
        if (count($this->settings)) {
            foreach ($this->settings as $index => $setting) {
                $this->destination[$index] = data_get($setting, 'destination');
                $this->name[$index] = data_get($setting, 'name');
                $this->expected_name[$index] = data_get($setting, 'expected_name');
                $this->condition[$index] = data_get($setting, 'condition');
                $this->api[$index] = data_get($setting, 'api');
            }
        }
    }

    private function getDestinations($destinations = [])
    {
        $machines = Machine::all();

        foreach ($machines as $machine) {
            if ($machine->sequences->count()) {
                foreach ($machine->sequences as $sequence) {
                    if ($sequence->steps->count()) {
                        foreach ($sequence->steps as $step) {
                            $destinations[] = ['id' => $step->id, 'name' => "{$machine->name}/{$sequence->name}/$step->name"];
                        }
                    }
                }
            }
        }

        return $destinations;
    }

    public function add()
    {
        $this->totalLine = $this->totalLine + 1;
    }

    public function save()
    {
        $conditions = [];

        if (count($this->name)) {
            foreach ($this->name as $i => $v) {
                $conditions[$i] = [
                    'name' => data_get($this->name, $i),
                    'destination' => data_get($this->destination, $i),
                    'expected_name' => data_get($this->expected_name, $i),
                    'condition' => data_get($this->condition, $i),
                    'api' => data_get($this->api, $i),
                ];
            }
        }


        try {
            DB::beginTransaction();

            $settings = $this->step->settings;
            $settings->condition = json_encode($conditions);
            // dd($conditions, json_encode($conditions), $settings->condition);
            $settings->save();

            $this->notification([
                'title'       => 'Sucesso!',
                'description' => "Atualizado com sucesso!",
                'icon'        => 'success'
            ]);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
        }            
    }
}