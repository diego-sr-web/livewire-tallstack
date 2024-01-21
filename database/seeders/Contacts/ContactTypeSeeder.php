<?php

namespace Database\Seeders\Contacts;

use App\Models\Contacts\ContactType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getContactTypes() as $contact) {
            ContactType::create($contact);
        }
    }

    public function getContactTypes(): array
    {
        $data = [
            // [
            //     'id' => 1,
            //     'label' => 'Email',
            //     'name' => 'email',
            //     'active' => true,
            //     'required' => true,
            // ],
            [
                'id' => 2,
                'label' => 'Email Adicional',
                'name' => 'email_aditional',
                'active' => true,
                'required' => false,
            ],
            [
                'id' => 3,
                'label' => 'Celular',
                'name' => 'phone',
                'active' => true,
                'required' => true,
            ],
            [
                'id' => 4,
                'label' => 'Telefone Adicional',
                'name' => 'phone_aditional',
                'active' => true,
                'required' => false,
            ],
        ];

        return $data;
    }
}
