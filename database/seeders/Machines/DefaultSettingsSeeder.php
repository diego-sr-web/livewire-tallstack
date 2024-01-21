<?php

namespace Database\Seeders\Machines;

use App\Models\Machines\DefaultSettings;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefaultSettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DefaultSettings::create([
            'name' => 'default',
            'condition' => json_encode($this->getDefaultSettingsEloquent()),
            'active' => 1,
            'type' => 'eloquent',
        ]);
        
        DefaultSettings::create([
            'name' => 'default',
            'condition' => json_encode($this->getDefaultSettingsConfig()),
            'active' => 1,
            'type' => 'config',
        ]);
    }

    private function getDefaultSettingsConfig()
    {
        return 
        [
            [
                'name' => 'excluido', 
                'expected_value' => 1,
                'condition' => '=',
                'destination' => [
                    'machine' => 1,
                    'sequency' => 5,
                    'step' => 15
                ],
                'api' => 'https://api.funildevendas.com.br/config/excluido',
            ],
            [
                'name' => 'enviado', 
                'expected_value' => 1,
                'condition' => '=',
                'destination' => [
                    'machine' => 1,
                    'sequency' => 5,
                    'step' => 15
                ],
                'api' => 'https://api.funildevendas.com.br/config/enviado',
            ],
            [
                'name' => 'bloqueado', 
                'expected_value' => 1,
                'condition' => '=',
                'destination' => [
                    'machine' => 1,
                    'sequency' => 5,
                    'step' => 15
                ],
                'api' => 'https://api.funildevendas.com.br/config/bloqueado',
            ],
            [
                'name' => 'invalido', 
                'expected_value' => 1,
                'condition' => '=',
                'destination' => [
                    'machine' => 1,
                    'sequency' => 5,
                    'step' => 15
                ],
                'api' => 'https://api.funildevendas.com.br/config/invalido',
            ],
        ];
    }

    private function getDefaultSettingsEloquent()
    {

       return 
       [
        'selects' =>
            [
                'leads.name',
                'leads.email',
                'companies.name'
            ],
        'joins' => 
            [
                [
                    'table' => 'companies',
                    'foreign_key' => 'leads.company_id',
                    'owner_key' => 'companies.id'
                ]
            ],
        'wheres' =>
            [
                [
                    'field' => 'internacionalization',
                    'condition' => '=',
                    'value' => 'BR',
                ],
                [
                    'field' => 'active',
                    'condition' => '=',
                    'value' => '1',
                ],
                [
                    'field' => 'status',
                    'condition' => '=',
                    'value' => '2',
                ],
                [
                    'field' => 'annual_declaration',
                    'condition' => '=',
                    'value' => '1',
                ],
                [
                    'field' => 'exclusive',
                    'condition' => '=',
                    'value' => '1',
                ]
            ],
        ];           
    }
}
