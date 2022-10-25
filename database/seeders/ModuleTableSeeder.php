<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ModuleTableSeeder extends Seeder
{

    public function run()
    {
        $module = new Module();
        $module->name = 'users_editor';
        $module->save();       
        
        $module = new Module();
        $module->name = 'home';
        $module->save();

        $module = new Module();
        $module->name = 'permission_asignation_editor';
        $module->save();

        $module = new Module();
        $module->name = 'permission_asignation_to_role';
        $module->save();

        $module = new Module();
        $module->name = 'permission_asignation_to_user';
        $module->save();
        
        $module = new Module();
        $module->name = 'permissions_roles_editor';
        $module->save();

        $module = new Module();
        $module->name = 'roles';
        $module->save();

        $module = new Module();
        $module->name = 'permissions';
        $module->save();

        $module = new Module();
        $module->name = 'modules';
        $module->save();

        $permissions_options = [
            'index',
            'show',
            'create',
            'edit',
            'delete',
            'restore',
            'export',
            'send',
        ];
        
        foreach ($permissions_options as $permission) {
            DB::table('permissions_options')->insert(['name' => $permission]);
        }
     
    }
}
