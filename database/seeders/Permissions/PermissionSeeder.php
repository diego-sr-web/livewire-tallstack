<?php

namespace Database\Seeders\Permissions;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Permissions\Role;
use App\Models\Permissions\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {             
        $roleSuperAdmin = Role::find(1);
        $roleAdmin = Role::find(2);

        foreach ($this->getPermissions() as $index1 => $items1) {
            $permission1 = Permission::create([
                'name' => $index1,
                'slug' => Str::slug($index1),                
            ]);
            
            if (Str::slug($index1) == 'admin-configuracoes') {
                $roleSuperAdmin->permissions()->attach($permission1->id);

                $permission1->global = 0;
                $permission1->save();
            } else {
                $roleAdmin->permissions()->attach($permission1->id);
            }

            foreach ($items1 as $index2 => $items2) {
                $permission2 = Permission::create([
                    'name' => $index2,
                    'slug' => Str::slug($index1.' '.$index2),
                    'permission_id' => $permission1->id,
                ]);

                if (Str::slug($index2) == 'configuracoes') {
                    $roleSuperAdmin->permissions()->attach($permission2->id);

                    $permission2->global = 0;
                    $permission2->save();
                } else {
                    $roleAdmin->permissions()->attach($permission2->id);
                }
                
                foreach ($items2 as $index3 => $items3) {
                    $permission3 = Permission::create([
                        'name' => !is_array($items3) ? $items3 : $index3,
                        'slug' => !is_array($items3) ? Str::slug($index1.' '.$index2.' '.$items3) : Str::slug($index1.' '.$index2.' '.$index3),
                        'permission_id' => $permission2->id,
                    ]);

                    if (Str::slug($index2) == 'configuracoes') {
                        $roleSuperAdmin->permissions()->attach($permission3->id);

                        $permission3->global = 0;
                        $permission3->save();
                    } else {
                        $roleAdmin->permissions()->attach($permission3->id);
                    }

                    if (is_array($items3)) {
                        foreach ($items3 as $index4 => $items4) {
                            $permission4 = Permission::create([
                                'name' => !is_array($items4) ? $items4 : $index4,
                                'slug' => !is_array($items4) 
                                    ? Str::slug($index1.' '.$index2.' '.$index3.' '.$items4) 
                                    : Str::slug($index1.' '.$index2.' '.$index3.' '.$index4),
                                'permission_id' => $permission3->id,
                            ]);
        
                            if (Str::slug($index2) == 'configuracoes') {
                                $roleSuperAdmin->permissions()->attach($permission4->id);

                                $permission4->global = 0;
                                $permission4->save();
                            } else {
                                $roleAdmin->permissions()->attach($permission4->id);
                            }
                        }
                    }                    
                }
            }            
        }
    }

    public function getPermissions()
    {
        $defaultOne = array('Listagem', 'Cadastrar', 'Alterar', 'Visualizar', 'Excluir');
        $defaultTwo = array_merge($defaultOne, array('Relatorio'));

        $permissions = [
            'Painel' => [
                'Maquinas' => $defaultTwo,
            ],
            'Admin' => [
                'Colaboradores' => $defaultTwo,
                'Papeis' => $defaultOne,
                'ACL' => $defaultOne,
                'Configurações' => [
                    'Empresas' => $defaultOne,
                    'Permissões' => $defaultOne,
                ]       
            ],
        ];

        return $permissions;
    }
}
