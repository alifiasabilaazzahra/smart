<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use App\Notifications\VerifyEmail;
use App\Student;
use App\Teacher;
use App\Helpers\Helper;
class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;
    /**
     * Assign new primary key
     */
    protected $primaryKey = 'user_id';

    /**
     * Set incrementing primary key to false
     */
    public $incrementing = false;

    /**
     * Appends attributes to object results.
     * 
     * @var array
     */
    protected $appends = [
        'is_role','account'
    ];


    /**
     * Set generate uuid value user_id.
     *
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->user_id = Helper::randString();
            $model->created_at = \Carbon\Carbon::now();
        });
    }
    
    /**
     * Append value to 'is_role'. Check value is not empty
     * 
     * @return Collection
     */
    protected function getIsRoleAttribute()
    {
        $dataRole = $this->attributes['role'];
        if ($dataRole === 0) {
            return "Student";
        } 
        if ($dataRole === 1) {
            return "Teacher";
        }
        if ($dataRole === 3) {
            return "Admin";
        }
        return false;
    }

    /**
     * Append value to 'account'. Check value is not empty
     * 
     * @return Collection
     */
    protected function getAccountAttribute()
    {
        $dataRole = $this->attributes['role'];
        if($dataRole === 0){
            return Student::where('user_id',$this->attributes['user_id'])->first();
        }

        if($dataRole === 1){
            return Teacher::where('user_id',$this->attributes['user_id'])->first();
        }
        return false;
    }
    
    /**
     * Override send email verification
     * 
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmail);
    }
}
