<?php

namespace Database\Seeders\Users;

use App\Models\Users\User;
use App\Models\Owners\Owner;
use App\Models\Users\Profile;
use Illuminate\Database\Seeder;
use App\Models\Contacts\Contact;
use App\Models\Permissions\Role;
use App\Models\Addresses\Address;
use App\Models\Companies\Company;
use App\Models\Documents\Document;
use App\Models\Collaborators\Collaborator;
use App\Models\Permissions\Permission;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Usuário admin dono do sistema
        $data = [
            'name' => 'Super Admin',
            'fantasy_name' => 'Administrador do Sistema',
            'cnpj' => cleanCnpjCpf('cnpj', fake('pt_BR')->cnpj), //'05058778000175',
            'email' => 'admin@funil.com',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
            'role_id' => 1
        ];
       
        $user = User::create([
            'email' => data_get($data, 'email'),
            'email_verified_at' => now(),
            'password' => data_get($data, 'password'),
            'is_admin' => data_get($data, 'is_admin') ?? 0,
        ]);

        $owner = Owner::create([
            'name' => data_get($data, 'name'),
            'fantasy_name' => data_get($data, 'fantasy_name'),
        ]);

        Document::create([
            'rel_id' => $owner->id,
            'rel_type' => $owner::class,
            'document_type_id' => 3,
            'document' => data_get($data, 'cnpj'),
        ]);

        Profile::create([
            'rel_id' => 1,
            'rel_type' => Owner::class,
            'user_id' => $user->id,
            'role_id' => data_get($data, 'role_id')
        ]);

        Address::create([
            'rel_id' => $owner->id,
            'rel_type' => Owner::class,
            'zip_code' => '83823-331',
            'street' => 'Rua Flamingos',
            'number' => '1564',
            'complement' => null,
            'neighborhood' => 'Nações',
            'city' => 'Fazenda Rio Grande',
            'state' => 'PR',
        ]);

        // Usuário admin dono da empresa
        $data = [
            'name' => 'Mei em Foco Ltda',
            'site' => fake('pt_BR')->domainName,
            'fantasy_name' => 'Mei Em Foco',
            'cnpj' => cleanCnpjCpf('cnpj', fake('pt_BR')->cnpj), //'05058778000175',
            'email' => 'admin@meiemfoco.com.br',
            'password' => bcrypt('12345678'),
            'is_admin' => 1,
            'role_id' => 1
        ];
       
        $user = User::create([
            'email' => data_get($data, 'email'),
            'email_verified_at' => now(),
            'password' => data_get($data, 'password'),
            'is_admin' => data_get($data, 'is_admin') ?? 0,
        ]);

        $company = Company::create([
            'name' => data_get($data, 'name'),
            'site' => data_get($data, 'site'),
            'fantasy_name' => data_get($data, 'fantasy_name'),
        ]);

        Role::firstOrCreate([
            'id' => 3,
            'name' => 'Admin',
            'slug' => 'admin',
            'company_id' => $company->id,
            'is_admin' => 1
        ]);

        $this->setRolePermissions('admin');
        
        Role::firstOrCreate([
            'id' => 4,
            'name' => 'Colaborador',
            'slug' => 'colaborador',
            'company_id' => $company->id,
        ]);

        $this->setRolePermissions('colaborador');

        Document::create([
            'rel_id' => $company->id,
            'rel_type' => $company::class,
            'document_type_id' => 3,
            'document' => data_get($data, 'cnpj'),
        ]);

        Profile::create([
            'rel_id' => $company->id,
            'rel_type' => $company::class,
            'user_id' => $user->id,
            'role_id' => data_get($data, 'role_id')
        ]);

        Address::create([
            'rel_id' => $company->id,
            'rel_type' => Company::class,
            'zip_code' => '83823-331',
            'street' => 'Rua Flamingos',
            'number' => '1564',
            'complement' => null,
            'neighborhood' => 'Nações',
            'city' => 'Fazenda Rio Grande',
            'state' => 'PR',
        ]);

        // Colaboradores
        foreach ($this->getUsers() as $data) {
            $user = User::create([
                'email' => data_get($data, 'email'),
                'email_verified_at' => now(),
                'password' => data_get($data, 'password'),
                'is_admin' => data_get($data, 'is_admin') ?? 0,
            ]);
            
            $collaborator = Collaborator::create([
                'name' => data_get($data, 'name'),
                'company_id' => $company->id,
            ]);

            Document::create([
                'rel_id' => $collaborator->id,
                'rel_type' => $collaborator::class,
                'document_type_id' => 1,
                'document' => cleanCnpjCpf('cpf', fake('pt_BR')->cpf),
            ]);

            Document::create([
                'rel_id' => $collaborator->id,
                'rel_type' => $collaborator::class,
                'document_type_id' => 2,
                'document' => fake('pt_BR')->rg,
            ]);

            Contact::create([
                'rel_id' => $collaborator->id,
                'rel_type' => $collaborator::class,
                'contact_type_id' => 3,
                'contact' => cleanPhone('phone', fake('pt_BR')->phoneNumber()),
            ]);

            Profile::create([
                'rel_id' => $collaborator->id,
                'rel_type' => $collaborator::class,
                'user_id' => $user->id,
                'role_id' => data_get($data, 'role_id')
            ]);

            Address::create([
                'rel_id' => $collaborator->id,
                'rel_type' => Collaborator::class,
                'zip_code' => '83823-331',
                'street' => 'Rua Flamingos',
                'number' => '1564',
                'complement' => null,
                'neighborhood' => 'Nações',
                'city' => 'Fazenda Rio Grande',
                'state' => 'PR',
            ]);
        }
    }

    private function getUsers($data = [])
    {
        $data = [
            [
                'name' => 'Funil Admin',
                'email' => 'funil@funil.com',
                'password' => bcrypt('12345678'),
                'role_id' => 3
            ],
            [
                'name' => 'Diego',
                'email' => 'diego@funil.com',
                'password' => bcrypt('12345678'),
                'role_id' => 4
            ],
            [
                'name' => 'Jaime',
                'email' => 'jaime@funil.com',
                'password' => bcrypt('12345678'),
                'role_id' => 4
            ],
            [
                'name' => 'Josimar',
                'email' => 'josimar@funil.com',
                'password' => bcrypt('12345678'),
                'role_id' => 4
            ],
        ];

        return $data;
    }

    private function setRolePermissions($roleName)
    {
        if ($roleName == 'admin') {
            $roleBase = Role::find(2);
            $roleNew = Role::find(3);
            
            foreach ($roleBase->permissions as $permission) {
                if (!strpos($permission->slug, 'configuracoes')) {
                    $roleNew->permissions()->attach($permission->id);
                }
            }
        }

        if ($roleName == 'colaborador') {
            $role = Role::find(4);
            $permission = Permission::where('slug', 'painel')->first();

            $role->permissions()->attach($permission->id);

            if ($permission->permissions->count()) {
                foreach ($permission->permissions as $permission2) {
                    $role->permissions()->attach($permission2->id);

                    if ($permission2->permissions->count()) {
                        foreach ($permission2->permissions as $permission3) {
                            $role->permissions()->attach($permission3->id);

                            if ($permission3->permissions->count()) {
                                foreach ($permission3->permissions as $permission4) {
                                    $role->permissions()->attach($permission4->id);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

// https://github.com/fzaninotto/Faker