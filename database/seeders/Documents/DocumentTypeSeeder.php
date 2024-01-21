<?php

namespace Database\Seeders\Documents;

use App\Models\Documents\DocumentType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DocumentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getDocumentTypes() as $document) {
            DocumentType::create($document);
        }
    }

    public function getDocumentTypes(): array
    {
        $data = [
            [
                'id' => 1,
                'label' => 'CPF',
                'name' => 'cpf',
                'active' => true,
                'required' => true,
                'type' => 'COL',
            ],
            [
                'id' => 2,
                'label' => 'RG',
                'name' => 'rg',
                'active' => true,
                'required' => true,
                'type' => 'COL',
            ],
            [
                'id' => 3,
                'label' => 'CNPJ',
                'name' => 'cnpj',
                'active' => true,
                'required' => true,
                'type' => 'COM',
            ],
        ];

        return $data;
    }
}
