<?php

namespace App\Actions\Machines;

use App\Models\Leads\Lead;
use App\Actions\Actionable;
use Illuminate\Support\Str;
use App\Models\Machines\Step;
use App\Jobs\StepSendEmailJob;
use App\Models\Machines\DefaultSettings;

class StepQueue extends Actionable
{
    public function handle(Step $step = null)
    {
        $settings = $this->getSettings($step);
        $leads = $this->query($settings)->get();

        if ($leads->count()) {
            foreach ($leads as $lead) {
                // StepSendEmailJob::dispatch($lead)
                //     // ->onQueue(Str::slug($step->name))
                //     ;
            }
        }
    }

    private function query(array $settings)
    {
        $queryLeads = Lead::query();

        foreach ($settings as $set) {
            $queryLeads->where($set->field, $set->condition, $set->value);
        }

        return $queryLeads;
    }

    public function getSettings(Step $step, $defaultSettigs = false): array
    {
        if ($defaultSettigs) {
            try {
                return json_decode(
                    DefaultSettings::query()
                    ->where('active', 1)
                    ->where('name', 'default')
                    ->first()
                    ->condition
                );            
            } catch (\Exception $e) {
                throw new \Exception('A configuração default não foi encontrada!');
            }
        }

        return json_decode($step->settings->condition);        
    }
}
