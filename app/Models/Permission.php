<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as Model;
use App\Models\Module;

class Permission extends Model
{
    use HasFactory;


    public function modules()
    {
        return $this->belongsTo(Module::class , 'module_id', 'id' );
    }

}
