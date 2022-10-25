<?php

namespace App\Models;

use DB;
use App\Models\Scopes\UserScope;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPassword;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\HasProfilePhoto;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    
    protected $guard_name = 'web';

    protected $fillable = [
        'name',
        'email',
        'active',
        'phone',
        'password',
        'profile_photo_path',
        'leader_id',
        'date_admission',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];


    protected $casts = [
        'email_verified_at' => 'date:d-m-Y',
        'date_admission' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d',
        'created_at' => 'date:Y-m-d',
    ];

    protected $appends = [
        'permission','isleader','status'
    ];

    /* protected static function booted()
    {
        static::addGlobalScope(new UserScope);
    } */

   
    
    public function getPermissionAttribute()
    {
        return $this->getAllPermissions();
    }

    public function getAllPermissionsAttribute()
    {
        $permissions = [];
        foreach (Permission::all() as $permission) {
            if (Auth::user()->can($permission->name)) {
                $permissions[] = $permission->name;
            }
        }
        return $permissions;
    }

    public function getNameAttribute($value)
    {
        return ucfirst($value);
    }

    public function getStatusAttribute()
    {
        if($this->active==="1"){
            return "Activo";
        }else{
            return "No activo";
        }
    }
                  
    public function getIsleaderAttribute()
    {
        return $this->isLeader();
    }

    public function leader()
    {
        return $this->hasOne(Leader::class,'id','leader_id'); //,'id','leader_id'
    }

    public function isLeader()
    {        
       /*  DB::enableQueryLog();  */
        return Leader::where('user_id', '=', $this->id)->exists();
       /*  dd(DB::getQueryLog()); */
    }

    public function isSuperUser()
    {
        return $this->roles->pluck('name')[0] === "super";
    }

    public function isAdminUser()
    {
        return $this->roles->pluck('name')[0] === "admin";
    }

    public function isSupervisorUser()
    {
        return $this->roles->pluck('name')[0] === "supervisor";
    }

    public function isNormalUser()
    {
        return $this->roles->pluck('name')[0] === "usuario";
    }

    public function scopeActive($query)
    {
        return $query->where('active', "1");
    }

    public function scopeNoactive($query)
    {
        return $query->where('active', "2");
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where('first_name', 'like', '%'.$search.'%')
                    ->orWhere('last_name', 'like', '%'.$search.'%')
                    ->orWhere('email', 'like', '%'.$search.'%');
            });
        })->when($filters['role'] ?? null, function ($query, $role) {
            $query->whereRole($role);
        })->when($filters['trashed'] ?? null, function ($query, $trashed) {
            if ($trashed === 'with') {
                $query->withTrashed();
            } elseif ($trashed === 'only') {
                $query->onlyTrashed();
            }
        });
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

   
    

}
