<?php
namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Module;
use App\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public function run(){   
        /* $user = User::find($id); */
        //$admin->givePermissionTo(Permission::all());

        $permissions_options =   DB::table('permissions_options')->get()->toArray();
        $modules = DB::table('modules')->get()->toArray();
        
        foreach($modules as $module){
            foreach ($permissions_options as $option) {

                if($module->id == 1){

                    $data = array(
                        "module_id" => $module->id,
                        "name" => $module->name.".".$option->name,
                        "guard_name" => "web"
                    );

                    Permission::create($data);    

                }else{
                    
                    if($option->id<=4){
                        $data = array(
                            "module_id" => $module->id,
                            "name" => $module->name.".".$option->name,
                            "guard_name" => "web"
                        );

                        Permission::create($data);  
                    }
                  
                }
              
            }
        }

        //SuperUsuario
            $super = Role::whereName("super")->firstOrFail();
            $super->givePermissionTo(Permission::all());
            $user1 = User::find(1); 
            $user1->assignRole('super');

         //Admin
            $admin = Role::whereName("admin")->firstOrFail();
            $admin->givePermissionTo([
                'users_editor.index',
                'users_editor.show',
                'users_editor.create',
                'users_editor.edit',
                'users_editor.delete',
                'users_editor.restore',
                'users_editor.export',
                'users_editor.send',
                'home.index',
                'permission_asignation_editor.index',
                'permission_asignation_to_role.index',
                'permission_asignation_to_user.index',
                'permissions_roles_editor.index',
                'roles.index',
                'permissions.index',
                'modules.index',
            ]);
            
            $user2 = User::find(2); 
            $user2->assignRole('admin');
            
         //supervisor

            $supervisor = Role::whereName("supervisor")->firstOrFail();
            $supervisor->givePermissionTo([
                'users_editor.index',
                'users_editor.show',
                'users_editor.create',
                'users_editor.edit',
                'users_editor.delete',
                'users_editor.restore',
                'users_editor.export',
                'users_editor.send',
                'home.index',
                'permission_asignation_editor.index',
                'permission_asignation_to_user.show',
                'permission_asignation_to_user.create',
                'permission_asignation_to_user.edit',
            ]);

            $user3 = User::find(3); 
            $user3->assignRole('supervisor');

         //usuario
        
            $usuario = Role::whereName("usuario")->firstOrFail();
            $usuario->givePermissionTo([
                'users_editor.index',
                'users_editor.show',
                'home.index',
            ]);
            
            $users = User::get();
            $usersCount = $users->count();

            for ($i=4; $i <=$usersCount ; $i++) { 
                $user = User::find($i); 
                $user->assignRole('usuario');
            }
           

    }
}
