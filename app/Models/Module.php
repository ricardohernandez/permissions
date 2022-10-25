<?php

namespace App\Models;

use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Module extends Model
{
    use HasFactory;

    protected $guard_name = 'web';
    public $timestamps = false;
    
    protected $fillable = [
        'name'
    ];

    /* protected $appends = [
        'permissions'
    ];

    public function getPermissionsAttribute()
    {
        $array = [];
        $options = DB::table('permissions_options')->get();
        foreach ($options as $option) {
            $array[] = $option->name;
        }
        return $array;
    } */

    public function permissions()
    {
        return $this->hasMany(Permission::class , 'module_id', 'id' );
    }


    
}
