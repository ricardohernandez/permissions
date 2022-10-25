<?php

namespace App\Http\Controllers\Back_end\Users;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class UsersPermissions extends Controller
{

    public function getUserPermissions()
    {
        $user = User::find(request("id"));
        $user_permissions = $user->permissions()->get()->toArray();
        $permissions = DB::table('permissions');

        if(Auth::user()->roles->pluck('name')[0]!="super"){
            $permissions->where('name','<>','users_editor.delete');
            $permissions->where('name','<>','users_editor.restore');
            $permissions->where('module_id','!=','3');
            $permissions->where('module_id','!=','4');
            $permissions->where('module_id','!=','6');
            $permissions->where('module_id','!=','7');
            $permissions->where('module_id','!=','8');
            $permissions->where('module_id','!=','9');
        }

        $permissions = $permissions->get()->toArray();
        
        $array = array();

        foreach ($permissions as $permission) {

            $temp = array();
            $temp["id"] = $permission->id;
            $temp["name"] = $permission->name;

            foreach ($user_permissions as $user_permission) {

                if ($permission->name == $user_permission["name"]) {
                    $temp["active"] = true;
                }
            }
            $array[] = $temp;
        }

        return $array;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'uservalue' => 'required',
            'permissionuservalue' => 'required'
        ]);

        try {

            $permisos_asignados = "";
            $permisos_denegados = "";
            $msg = "";

            foreach ($request->permissionuservalue as $p) {

                $permiso = $p["value"];
                $id_permission = Permission::where('name', $permiso)->first()->id;

                try {

                    $user = User::find($request->uservalue);

                    if ($user->hasPermissionTo($permiso)) {
                        $permisos_denegados .= $permiso . " , ";
                    } else {
                        $user->givePermissionTo($id_permission);
                        $permisos_asignados .= $permiso . " , ";
                    }
                } catch (Exception $exception) {

                    return response()->json([
                        "res" => "error",
                        "msg" => $exception,
                    ], 200);
                }
            }


            if ($permisos_asignados == "") {
                $msg .= "Permisos ya existentes.";
            } else {
                $msg .= "Permisos asignados : " . $permisos_asignados;
            }

            return redirect()->route('permissions_asignation')->with('message_success', $msg);
        } catch (Exception $exception) {
            return redirect()->route('permissions_asignation')->with('message_error',  __('save_error'));
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'permissions' => ''
        ]);

        try {
            $user = User::find($request->id);
            $user->syncPermissions($request->permissions);
            return redirect()->route('permissions_asignation')->with('message_success', __('update_ok'));
        } catch (Exception $exception) {
            return redirect()->route('permissions_asignation')->with('message_error',  __('save_error'));
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->syncPermissions([]);
        return redirect()->route('permissions_asignation')->with('message_success', __('deleted_ok'));
    }
}
