<?php

namespace App\Http\Controllers\Back_end\Users;

use Inertia\Inertia;
use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PermissionController extends Controller
{
    public function create()
    {
        return Inertia::render('Back_end/Permissions/PermissionsForm');
    }

    public function store(Request $request)
    {
        try {
            
            $validatedData = $request->validate([
                'permission' => 'required|min:1|max:255',
                'module_id' => 'required|min:1|max:255'
            ]);

           
            $module = Module::find($request->module_id);

            foreach($request->permission as $p){
                
                $permission = $module->name.".".$p["value"];

                $data =  [
                    'module_id' => $request->module_id,
                    'name' => $permission
                ];

                if (Permission::where('module_id', $request->module_id )->exists()) {
                    if (Permission::where('name', $permission )->doesntExist()) {
                        Permission::updateOrCreate(['id' => $request->id], $data);
                    }else{
                       return redirect()->route('roles_permissions')->with('message_error',  __('record_exist'));
                    }
                }else{
                    Permission::updateOrCreate(['id' => $request->id], $data);
                }
                
            }

            return redirect()->route('roles_permissions')->with('message_success', __('save_ok'));

        } catch (Exception $exception) {
            return redirect()->route('roles_permissions')->with('message_error',  __('save_error'));
        }
    }

    public function update(Request $request, Module $module)
    {
        try {
            
            $validatedData = $request->validate([
                'module_id' => 'required|min:1|max:255'
            ]);

            $module = Module::find($request->module_id);
            Permission::where(['module_id' => $request->module_id])->delete();

            foreach($request->permissions as $p){
                $permission = $module->name.".".$p;

                $data =  [
                    'module_id' => $request->module_id,
                    'name' => $permission
                ];
                
                Permission::updateOrCreate(['module_id' => $request->module_id , 'name' => $request->name], $data);
            }

            return redirect()->route('roles_permissions')->with('message_success', __('save_ok'));

        } catch (Exception $exception) {
            return redirect()->route('roles_permissions')->with('message_error',  __('save_error'));
        }
    }
    
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('roles_permissions')->with('message_success', __('deleted_ok'));
    }


}
