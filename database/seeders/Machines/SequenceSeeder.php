<?php

namespace Database\Seeders\Machines;

use Illuminate\Database\Seeder;
use App\Models\Machines\Sequence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SequenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getSequences() as $sequence) {
            Sequence::create($sequence);
        }
    }

    private function getSequences($data = [])
    {
        $data = [
            [
                'id' => 1,
                'machine_id' => 1,
                'name' => 'Sequencia 01',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 2,
                'machine_id' => 2,
                'name' => 'Qualquer nome',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 3,
                'machine_id' => 3,
                'name' => 'Emprendedorismo',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 4,
                'machine_id' => 3,
                'name' => 'Finanças',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 5,
                'machine_id' => 3,
                'name' => 'Investimento',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 6,
                'machine_id' => 4,
                'name' => 'Pre venda',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
            [
                'id' => 7,
                'machine_id' => 4,
                'name' => 'Vendas',
                'description' => null,
                'active' => 1,
                'status' => 0,
            ],
        ];

        return $data;
    }
}