<?php

namespace Database\Seeders\Permissions;

use App\Models\Permissions\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'id' => 1,
            'name' => 'Super Admin',
            'slug' => 'super-admin',
        ]);

        Role::firstOrCreate([
            'id' => 2,
            'name' => 'Admin',
            'slug' => 'admin',
        ]);        
        
    }
}
