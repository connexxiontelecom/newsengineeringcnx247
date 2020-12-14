<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//use Illuminate\Contracts\Auth\Access\Authorizable;
use Spatie\Permission\Traits\HasRoles;
use Cache;
use Tymon\JWTAuth\Contracts\JWTSubject;
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getJWTIdentifier()
    {
        return $this->getKey();


    }
    public function getJWTCustomClaims()
    {
        return [];
    }


    /*
    * Each experience belongs to a user
    */
    public function experience(){
        return $this->hasMany(Experience::class, 'user_id');
    }
    public function education(){
        return $this->hasMany(Education::class, 'user_id');
    }
    public function emergencyContact(){
        return $this->hasMany(EmergencyContact::class, 'user_id');
    }
    public function nextKin(){
        return $this->hasMany(NextKin::class, 'user_id');
    }
    public function tenant(){
        //1. tenant_id on users table
        //2. tenant_id on tenants table
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }

    //department - user relationship
    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    }


    public function tenantBankDetails(){
        return $this->belongsTo(TenantBankDetail::class, 'tenant_id', 'tenant_id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class, 'tenant_id');
    }
    public function userTheme(){
        return $this->belongsTo(Theme::class, 'active_theme');
    }
    public function userMaritalStatus(){
        return $this->belongsTo(MaritalStatus::class, 'marital_status');
    }


    public function myResponsibilities(){
        return $this->hasMany(ResponsiblePerson::class, 'user_id');
    }

    public function isOnline(){
        return Cache::has('user-is-online'.$this->id);
    }

    public function getUsers()
		{
			return $this->hasMany(Tenant::class, 'tenant_id', 'tenant_id');
		}

    public function getPolicy(){
        return $this->belongsTo(Policy::class, 'tenant_id');

    }
 /*    public function leaveWallet(){
        return $this->belongsTo(LeaveWallet::class);
    } */


    //Mutator
/*     public function setVerificationLinkAttribute($value){
        $value = substr(sha1(time()), 5,15); //override value
        $this->attributes['verification_link'] = $value;
    } */
}
