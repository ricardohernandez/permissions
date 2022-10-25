<?php

namespace App\Http\Controllers\Back_end\Users;

use App\Models\Module;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    public function create(){
        return Inertia::render('Back_end/Modules/Modules');
    }
    
    public function store(Request $request){

        $validatedData = $request->validate([
            'namemodule' => 'required|min:2|max:255|unique:modules,name'
        ]);

        $data =  [
            'name' => $request->namemodule,
        ];

        try {
            $user = Module::create($data);
            return redirect()->route('roles_permissions')->with('message_success', __('save_ok'));
        } catch (Exception $exception) {
            return redirect()->route('modules.create')->with('message_error',  __('save_error'));
        }

    }

    public function edit(Module $module)
    {
        return Inertia::render('Back_end/Modules/ModulesForm', ['moduledata' => $module]);
    }

    public function update(Request $request, Module $module)
    {
        $validatedData = $request->validate([
            'namemodule' => 'required|min:2|max:255|unique:modules,name,'.$request->id
        ]);

        $data =  ['name' => $request->namemodule];

        try {
            $module->update($data);
            return redirect()->route('roles_permissions')->with('message_success', __('update_ok'));
        } catch (Exception $exception) {
            return redirect()->route('modules.edit', $request->id)->with('message_error',  __('updated_error'));
        }
    }
    
    public function destroy(Module $module)
    {
        $module->delete();
        return redirect()->route('roles_permissions')->with('message_success', __('deleted_ok'));
    }
    


    

}
