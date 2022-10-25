<?php

namespace App\Http\Controllers\Back_end\Users;

use stdClass;
use Inertia\Inertia;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\Permission;

class RolesPermissionsController extends Controller
{
    public function index()
    {
        $roles = Role::with(['permissions']);

        if(request('search')){
            $roles->where('name' , 'LIKE' ,'%'.request('search').'%');
        }

        if(request()->has(['field', 'direction'])){
            $roles->orderBy(request('field'),request('direction'));
        }
        
        if(Auth::user()->roles->pluck('name')[0]!="super"){
            $roles->whereNotIn('name', ['super', 'admin']);
        }
        
        $modules_permissions =  Module::with("permissions");

        if(request('searchp')){
            $modules_permissions->where('name' , 'LIKE' ,'%'.request('searchp').'%');
        }

        if(request()->has(['fieldp', 'directionp'])){
            $modules_permissions->orderBy(request('fieldp'),request('directionp'));
        }

        if(Auth::user()->roles->pluck('name')[0]!="super"){
            $modules_permissions->where('name','!=','users');
            $modules_permissions->where('name','!=','modules');
            $modules_permissions->where('name','!=','roles');
            $modules_permissions->where('name','!=','permissions');
        }
        
        $modules = DB::table('modules');

        if(request('searchm')){
            $modules->where('name' , 'LIKE' ,'%'.request('searchm').'%');
        }

        if(request()->has(['fieldm', 'directionm'])){
            $modules->orderBy(request('fieldm'),request('directionm'));
        }

        /* if(Auth::user()->roles->pluck('name')[0]!="super"){
            $modules = [];
        } */

        $user = auth()->user();

        if ($user->can('roles.index')) {

            return Inertia::render('Back_end/Users/Roles_permissions/Index', [
                'roles' => $roles->paginate(15, '*', 'roles')->withQueryString(),
                'modules_permissions' => $modules_permissions->paginate(15, '*', 'modules')->withQueryString(),
                'modules' => $modules->paginate(15, '*', 'modules')->withQueryString(),
                'modulesItems' => $this->getModulesItems(),
                'permissionsOptions' => $this->getPermissionsOptions(),
                'tbfilters' => request()->all([
                        'search' , 'field' , 'direction',
                        'searchp' , 'fieldp' , 'directionp',
                        'searchm' , 'fieldm' , 'directionm',
                ])
            ]);

        } else {
            abort(403);
        }
    }

    public function getModulesItems()
    {
        $modules = DB::table('modules')->get()->toArray();
        $array = array();

        if (count($modules) > 0) {
            foreach ($modules as $key) {
                $object = new stdClass();
                $object->value = $key->id;
                $object->label = $key->name;
                $array[] = $object;
            }
        }

        return $array;
    }

    public function getPermissionsOptions()
    {
        $permissions = DB::table('permissions_options')->get()->toArray();
        $array = array();

        if (count($permissions) > 0) {
            foreach ($permissions as $key) {
                $array[] = $key->name;
            }
        }

        return $array;
    }

}
