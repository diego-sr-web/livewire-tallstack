<?php

namespace App\Actions\Machines;

use App\Actions\Actionable;
use App\Models\Leads\Lead;
use App\Models\Machines\DefaultSettings;
use App\Models\Machines\Step;

class StepSettingsQueue extends Actionable
{
    public function handle(Step $step = null)
    {
        $settings = $this->getSettings($step);
        $leads = $this->query($settings)->get();

        if ($leads->count()) {
            foreach ($leads as $lead) {
                //
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
