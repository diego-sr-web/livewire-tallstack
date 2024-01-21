<?php

namespace Database\Seeders\Machines;

use Illuminate\Database\Seeder;
use App\Models\Machines\StepSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StepSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getStepSettings() as $stepSettings) {
            StepSettings::create($stepSettings);
        }
    }

    private function getStepSettings($data = [])
    {
        for ($i=5; $i <=24; $i++) {
            $data[] =
                [
                    'id' => $i,
                    'condition' => '[{"field": "internacionalization", "value": "BR", "condition": "="}, {"field": "active", "value": "1", "condition": "="}, {"field": "status", "value": "2", "condition": "="}, {"field": "annual_declaration", "value": "1", "condition": "="}, {"field": "exclusive", "value": "1", "condition": "="}]',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
        }

        return $data;
    }
}