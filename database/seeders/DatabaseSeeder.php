<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Leads\Lead;
use Database\Factories\Leads\LeadFactory;
use Database\Seeders\Contacts\ContactTypeSeeder;
use Database\Seeders\Documents\DocumentTypeSeeder;
use Database\Seeders\Machines\DefaultSettingsSeeder;
use Database\Seeders\Machines\MachineSeeder;
use Database\Seeders\Machines\SequenceSeeder;
use Database\Seeders\Machines\StepSeeder;
use Database\Seeders\Machines\StepSettingsSeeder;
use Database\Seeders\Permissions\PermissionSeeder;
use Database\Seeders\Permissions\RoleSeeder;
use Database\Seeders\Users\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Users\User::factory(10)->create();
        
        // \App\Models\Users\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            ContactTypeSeeder::class,
            DocumentTypeSeeder::class,
            UserSeeder::class,
            MachineSeeder::class,
            DefaultSettingsSeeder::class,
            SequenceSeeder::class,
            StepSettingsSeeder::class,
            StepSeeder::class
        ]);

        // \App\Models\Leads\Lead::factory(10000)->create();
    }
}
