<?php

namespace App\Http\Controllers\Back_end\Users;

use stdClass;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionsAsignation extends Controller
{
    public function index()
    {

        $user = auth()->user();

        if ($user->can('permission_asignation_editor.index')) {

            return Inertia::render(
                'Back_end/Users/PermissionsAsignation/Index',
                [
                    'roleshaspermissions' => $this->rolesWithPermissionsList(),
                    'roles_items' => Role::get(),
                    'permission_items' => $this->getPermissionsItems(),

                    'users' => $this->getUserList(),
                    'users_items' => $this->getUserItems(),

                    'tbfilters' => request()->all([
                        'searchus', 'fieldus', 'directionus',
                        'searchh', 'fieldh', 'directionh',
                    ])
                ]
            );

        } else {
            abort(403);
        }
    }


    public function getRolePermissions()
    {
        $role = Role::find(request("id"));
        $role_permissions = $role->permissions()->get()->toArray();
        $permissions = DB::table('permissions');

        if(Auth::user()->roles->pluck('name')[0]!="super"){
            $permissions->where('name','!=','modules.index');
            $permissions->where('name','!=','modules.create');
            $permissions->where('name','!=','modules.show');
            $permissions->where('name','!=','modules.edit');
        }

        $permissions = $permissions->get()->toArray();
        $array = array();

        foreach ($permissions as $permission) {

            $temp = array();
            $temp["id"] = $permission->id;
            $temp["name"] = $permission->name;

            foreach ($role_permissions as $role_permission) {

                if ($permission->name == $role_permission["name"]) {
                    $temp["active"] = true;
                }
            }
            $array[] = $temp;
        }

        return $array;
    }

    public function getPermissions()
    {
        $permissions = DB::table('permissions');


        if (request('searchp')) {
            $permissions->where('name', 'LIKE', '%' . request('searchp') . '%');
        }

        if (request()->has(['fieldp', 'directionp'])) {
            $permissions->orderBy(request('fieldp'), request('directionp'));
        }

        if(Auth::user()->roles->pluck('name')[0]!="super"){
            $permissions->where('name','!=','modules.index');
            $permissions->where('name','!=','modules.create');
            $permissions->where('name','!=','modules.show');
            $permissions->where('name','!=','modules.edit');
        }

        return $permissions->get();
    }
    
    public function getPermissionsItems()
    {
        $permission_items = DB::table('permissions');

        if(Auth::user()->roles->pluck('name')[0]!="super"){
            $permission_items->where('name','!=','modules.index');
            $permission_items->where('name','!=','modules.create');
            $permission_items->where('name','!=','modules.show');
            $permission_items->where('name','!=','modules.edit');
        }

       /*  if(Auth::user()->roles->pluck('name')[0]=="supervisor"){
            $permission_items->where('module_id','=','2');
            $permission_items->orWhere('name','=','users_editor.index');
            $permission_items->orWhere('name','=','users_editor.show');
            $permission_items->orWhere('name','=','users_editor.create');
            $permission_items->orWhere('name','=','users_editor.edit');
        } */

        $permission_items = $permission_items->get()->toArray();
        $permissions_items = array();

        if (count($permission_items) > 0) {
            foreach ($permission_items as $key) {
                $object = new stdClass();
                $object->value = $key->name;
                $object->label = $key->name;
                $permissions_items[] = $object;
            }
        }

        return $permissions_items;

        /* $modules = Module::get()->toArray();
        $permissions_items = array();

        foreach($modules as $module){
            $permission_items = Permission::join('modules', 'modules.id', '=', 'permissions.module_id')
                ->select('permissions.*', 'modules.name as module_name')
                ->where('modules.id', $module["id"])
                ->orderBy('permissions.id', 'asc')
                ->get()->toArray();

            if(count($permission_items)>0){
    
                $temp = array();

                foreach($permission_items as $key) {
                    $temp[] = $key["name"];
                }
    
                $options = $temp; 
                $object = new stdClass();
                $object->label = $key["module_name"];
                $object->options = $options;
                $permissions_items[] = $object;
            }
        } */
    }


    public function getUserList()
    {
        $users = User::with(['permissions', 'roles']);

        if (request('searchus')) {
            $users->where('name', 'LIKE', '%' . request('searchus') . '%');
        }

        if (request()->has(['fieldus', 'directionus'])) {
            $users->orderBy(request('fieldus'), request('directionus'));
        }

        $user = Auth::user();
        if($user->roles->pluck('name')[0]!="super"){
            $users->whereHas('roles', function ($users) {
                $users->where('name','!=', 'super');
            });
        }

        if($user->roles->pluck('name')[0]=="supervisor"){
            $users->whereHas('roles', function ($users) {
                $users->where('name','!=', 'super');
                $users->where('name','!=', 'admin');
                $users->where('name','!=', 'supervisor');
             });
        }

        $users->where('active', '=', "1");
        return $users->paginate(15, '*', 'users')->withQueryString();
    }

    public function getUserItems()
    {
        $query = User::with(['permissions', 'roles']);
      
        $user = Auth::user();
        if($user->roles->pluck('name')[0]!="super"){
            $query->whereHas('roles', function ($query) {
                 $query->where('name','!=', 'super');
            });
        }

        if($user->roles->pluck('name')[0]=="supervisor"){
            $query->whereHas('roles', function ($query) {
                $query->where('name','!=', 'super');
                $query->where('name','!=', 'admin');
                $query->where('name','!=', 'supervisor');
             });
        }

      
        $users_items = array();

        if(count($query->get()->toArray()) > 0) {
            foreach ($query->get()->toArray() as $key) {
                $object = new stdClass();
                $object->value = $key["id"];
                $object->label = $key["name"];
                $users_items[] = $object;
            }
        }

        return $users_items;
    }

    public function rolesWithPermissionsList()
    {

        $roleshaspermissions = Role::with(['permissions']);
        if (request('searchh')) {
            $roleshaspermissions->where('name', 'LIKE', '%' . request('searchh') . '%');
        }

        if (request()->has(['fieldh', 'directionh'])) {
            $roleshaspermissions->orderBy(request('fieldh'), request('directionh'));
        }

        if (Auth::user()->roles->pluck('name')[0] != "super") {
            $roleshaspermissions->where('name', '!=', 'super');
            $roleshaspermissions->where('name', '!=', 'admin');
        }

        return $roleshaspermissions->paginate(15, '*', 'roleshaspermissions')->withQueryString();
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'rolesitems' => 'required',
            'permissionvalue' => 'required'
        ]);


        /* $id_permission = Permission::where('name', $request->permissionselect)->first()->id; */

        /* $role = $request->rolesitems;
        $role = Role::find($role);
        $permission = $request->permissionselect;
        $role->givePermissionTo([$permission]); */

        try {

            $permisos_asignados = "";
            $permisos_denegados = "";
            $msg = "";
            foreach ($request->permissionvalue as $p) {
                $permiso = $p["value"];
                $id_permission = Permission::where('name', $permiso)->first()->id;
                try {
                    $role = Role::find($request->rolesitems);
                    /* $permiso_name = Permission::findById($id_permission); */

                    if ($role->hasPermissionTo($permiso)) {
                        $permisos_denegados .= $permiso . " , ";
                    } else {
                        $role->givePermissionTo($id_permission);
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

            /* if($permisos_denegados!=""){
                $msg.="Ya existentes : ".$permisos_denegados;
            } */

            /* if(isset($request->rolesitems)){
                $permissions = $request->permissionselect;
                $role = $request->rolesitems;
                $role = Role::find($role);
                $role->syncPermissions($permissions);
            }else{
                $role->syncPermissions([]);
            } */

            return redirect()->route('permissions_asignation')->with('message_success', $msg);
        } catch (Exception $exception) {
            return redirect()->route('permissions_asignation')->with('message_error',  __('save_error'));
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'permissions' => 'required'
        ]);

        try {
            $role = Role::find($request->id);
            $role->syncPermissions($request->permissions);
            return redirect()->route('permissions_asignation')->with('message_success', __('update_ok'));
        } catch (Exception $exception) {
            return redirect()->route('permissions_asignation')->with('message_error',  __('save_error'));
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->syncPermissions([]);
        return redirect()->route('permissions_asignation')->with('message_success', __('deleted_ok'));
    }
}
