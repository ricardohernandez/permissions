<?php

namespace App\Http\Controllers\Back_end\Users;

use stdClass;
use Inertia\Inertia;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{

    public function create()
    {
        return Inertia::render('Back_end/Roles_permissions/Roles/RolesForm');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'namerole' => 'required|min:2|max:255|unique:roles,name,'.$request->role_id
        ]);

        $data =  ['name' => $request->namerole];

        try {
            
            $role = Role::updateOrCreate(['id' => $request->role_id], $data);

            if(isset($request->role_permissions)){
                $permissions = $request->role_permissions;
                $role->syncPermissions($permissions);
            }else{
                $role->syncPermissions([]);
            }

            return redirect()->route('roles_permissions')->with('message_success', __('save_ok'));

        } catch (Exception $exception) {
            return redirect()->route('roles_permissions')->with('message_error',  __('save_error'));
        }
    }

    public function update(Request $request , Role $role)
    {
        $validatedData = $request->validate([
            'namerole' => 'required|min:2|max:255|unique:roles,name'
        ]);

        $data =  ['name' => $request->namerole];

        try {
            $role->update($data);
            return redirect()->route('roles_permissions')->with('message_success', __('update_ok'));
        } catch (Exception $exception) {
            return redirect()->route('roles_permissions')->with('message_error',  __('updated_error'));
        }
    }

   
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('roles_permissions')->with('message_success', __('deleted_ok'));
    }


    

    
}
