<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    
    public function viewAny(User $user)
    {
        if ($user === null) {
            return false;
        }
    }

    public function view(User $user, User $model)
    {
        if ($user->can('users_editor.index')) {
            return true;
        }
    }

    public function show(User $auth_user, User $param_user)
    {
        
        if($auth_user->isNormalUser()){
            return $param_user->id == $auth_user->id;
        }

        if($auth_user->isSupervisorUser()){
            if($param_user->leader->id!=$auth_user->id && $auth_user->id!=$param_user->id){
                return false;
            }
        }
        
        //SI EL USUARIO ES EL SUPER Y EL LOGEADO NO LO ES
        if($param_user->isSuperUser() && !$auth_user->isSuperUser()){
            return false;
        }

        if ($auth_user->can('users_editor.show')) {
            return true;
        }
    }

    public function create(?User $user)
    {
        if ($user->can('users_editor.create')) {
            return true;
        }
    }

    public function update(User $auth_user , User $param_user)
    {
        
        //SI EL USUARIO LOGEADO ES SUPERVISOR 
        if($auth_user->isSupervisorUser()){
            if($param_user->leader->id!=$auth_user->id && $auth_user->id!=$param_user->id){
                return false;
            }
        }
           
        //SI EL USUARIO ES EL SUPER Y EL LOGEADO NO LO ES
        if($param_user->isSuperUser() && !$auth_user->isSuperUser()){
            return false;
        }

        if ($auth_user->can('users_editor.edit')) {
            return true;
        }
        
    }

    public function delete(User $user, User $model)
    {
        if ($user->can('users_editor.delete')) {
            return true;
        }
    }

    public function restore(User $user, User $model)
    {
        if ($user->can('users_editor.restore')) {
            return true;
        }
    }

    public function export(User $user)
    {
        if ($user->can('users_editor.export')) {
            return true;
        }
    }

    public function send(User $user)
    {
        if ($user->can('users_editor.send')) {
            return true;
        }
    }

    public function forceDelete(User $user, User $model)
    {
        //
    }
}
