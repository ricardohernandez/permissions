<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder{

    public function run() {
        $role = new Role();
        $role->name = 'super';
        $role->guard_name = 'web';
        $role->save();       
        
        $role = new Role();
        $role->name = 'admin';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role();
        $role->name = 'supervisor';
        $role->guard_name = 'web';
        $role->save();

        $role = new Role();
        $role->name = 'usuario';
        $role->guard_name = 'web';
        $role->save();
    }
}
