<?php

namespace App\Http\Livewire\Panel\Machines\Sequence\Step\Settings;

use Livewire\Component;
use App\Models\MailTemplate;
use App\Models\Machines\Step;
use Illuminate\Support\Facades\DB;
use WireUi\Traits\Actions;

class Template extends Component
{
    use Actions;

    public ?int $template_id = 0;
    public Step $step;

    public function mount()
    {
        $this->template_id = $this->step->mail_template_id;
    }

    public function render()
    {
        $templates = MailTemplate::query()
            ->where('page', 'mail-marketing')
            ->get();

        return view('livewire.panel.machines.sequence.step.settings.template', [
            'templates' => $templates
        ]);
    }

    public function save()
    {
        try {
            DB::beginTransaction();

            if ($this->template_id && data_get($this->step, 'id')) {
                
                $this->step->mail_template_id = $this->template_id;
                $this->step->save();
    
                $this->notification([
                    'title' => 'Sucesso!',
                    'description' => 'Atualizado com sucesso!',
                    'icon' => 'success',
                ]);
            }
            
            DB::commit();

            $this->emit('refreshSequences');
        } catch (\Exception $e) {
            DB::rollBack();

            $this->notification([
                'title' => 'Erro!',
                'description' => 'Erro ao tentar atualizar!',
                'icon' => 'error',
            ]);
        }


        
    }
}
