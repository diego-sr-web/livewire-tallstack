<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step\Settings;

use App\Models\Machines\Step;
use Illuminate\Support\Facades\DB;
use LivewireUI\Modal\ModalComponent;
use WireUi\Traits\Actions;

class Index extends ModalComponent
{
    use Actions;

    public $condition;
    public Step $step;

    public $tabDisabled = [];

    public $activeComponent = [1 => 'config'];

    protected $rules = [
        'name' => 'required|string',
    ];

    public function mount(Step $step)
    {
        $this->step = $step;
    }

    public function render()
    {
        return view('livewire.panel.machines.sequence.step.settings.index');
    }

    public function openTab($tab)
    {
        $this->activeComponent[1] = $tab;
    }

    public function save()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            DB::commit();

            $this->notification([
                'title' => 'Sucesso!',
                'description' => 'Atualizado com sucesso!',
                'icon' => 'success',
            ]);

            $this->emit('refreshSequences');
        } catch (\Exception $e) {
            DB::rollBack();

            $this->notification([
                'title' => 'Erro!',
                'description' => 'Erro ao tentar atualizar as configurações!',
                'icon' => 'error',
            ]);
        }

        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
