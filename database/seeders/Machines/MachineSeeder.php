<?php

namespace Database\Seeders\Machines;

use App\Models\Machines\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getMachines() as $machine) {
            Machine::create($machine);
        }
    }

    private function getMachines($data = [])
    {
        $data = [
            [
                'id' => 1,
                'company_id' => 1,
                'name' => 'Teste 01',
                'slug' => 'teste-01',
                'description' => null,
                'file' => 'images/maquina.jpg',
                'status' => 0,
            ],
            [
                'id' => 2,
                'company_id' => 1,
                'name' => 'Excluídos',
                'slug' => 'excluidos',
                'description' => null,
                'file' => 'images/maquina.jpg',
                'status' => 0,
            ],
            [
                'id' => 3,
                'company_id' => 1,
                'name' => 'Conteúdo',
                'slug' => 'conteudo',
                'description' => null,
                'file' => 'images/maquina.jpg',
                'status' => 0,
            ],
            [
                'id' => 4,
                'company_id' => 1,
                'name' => 'Vendas',
                'slug' => 'vendas',
                'description' => null,
                'file' => 'images/maquina.jpg',
                'status' => 0,
            ],
        ];

        return $data;
    }
}