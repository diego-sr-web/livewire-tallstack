<?php

namespace Database\Seeders\Machines;

use Illuminate\Database\Seeder;
use App\Models\Machines\Step;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getSteps() as $step) {
            Step::create($step);
        }
    }

    private function getSteps($data = [])
    {
        $data = [
            [
                'id' => 2,
                'sequence_id' => 1,
                'step_settings_id' => 6,
                'name' => 'Etapa 02',
                'description' => null,
                'order' => 0,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 1,
                'sequence_id' => 1,
                'step_settings_id' => 5,
                'name' => 'Etapa 01',
                'description' => null,
                'order' => 1,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 3,
                'sequence_id' => 2,
                'step_settings_id' => 7,
                'name' => 'Excluídos',
                'description' => null,
                'order' => 3,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 4,
                'sequence_id' => 2,
                'step_settings_id' => 8,
                'name' => 'Bloquedos',
                'description' => null,
                'order' => 4,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 5,
                'sequence_id' => 2,
                'step_settings_id' => 9,
                'name' => 'Inválidos',
                'description' => null,
                'order' => 5,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 6,
                'sequence_id' => 3,
                'step_settings_id' => 10,
                'name' => 'Janeiro',
                'description' => null,
                'order' => 6,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 7,
                'sequence_id' => 3,
                'step_settings_id' => 11,
                'name' => 'Fevereiro',
                'description' => null,
                'order' => 7,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 8,
                'sequence_id' => 3,
                'step_settings_id' => 12,
                'name' => 'Março',
                'description' => null,
                'order' => 8,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 9,
                'sequence_id' => 4,
                'step_settings_id' => 13,
                'name' => 'Janeiro',
                'description' => null,
                'order' => 9,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 10,
                'sequence_id' => 4,
                'step_settings_id' => 14,
                'name' => 'Fevereiro',
                'description' => null,
                'order' => 10,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 11,
                'sequence_id' => 4,
                'step_settings_id' => 15,
                'name' => 'Março',
                'description' => null,
                'order' => 11,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 12,
                'sequence_id' => 5,
                'step_settings_id' => 16,
                'name' => 'Janeiro',
                'description' => null,
                'order' => 11,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 13,
                'sequence_id' => 5,
                'step_settings_id' => 17,
                'name' => 'Fevereiro',
                'description' => null,
                'order' => 13,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 14,
                'sequence_id' => 5,
                'step_settings_id' => 18,
                'name' => 'Março',
                'description' => null,
                'order' => 14,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 15,
                'sequence_id' => 6,
                'step_settings_id' => 19,
                'name' => 'Pre Venda 01',
                'description' => null,
                'order' => 14,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 16,
                'sequence_id' => 6,
                'step_settings_id' => 20,
                'name' => 'Email 02',
                'description' => null,
                'order' => 16,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 18,
                'sequence_id' => 7,
                'step_settings_id' => 22,
                'name' => 'Vendas 01',
                'description' => null,
                'order' => 18,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 19,
                'sequence_id' => 7,
                'step_settings_id' => 23,
                'name' => 'Vendas 02',
                'description' => null,
                'order' => 19,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 20,
                'sequence_id' => 7,
                'step_settings_id' => 24,
                'name' => 'Vendas 03',
                'description' => null,
                'order' => 20,
                'active' => 1,
                'status' => 0,
            ],
            
        ];

        return $data;
    }
}