<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'name',
        'dob',
        'password',
        'role_id',
        'status',
    ];

    public const VALIDATION_RULES = [
        // 'avatar'    => 'required|image',
        'name'    => 'required',
        'email'     => [
                        'required',
                        'max:200',
                        'email',
                        'unique:users',
                        ],
        // 'role_id'   => 'required|exists:roles,id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function profile(){
        return $this->belongsTo(UserProfile::class,'id','user_id');
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }

    public function country(){
        return $this->belongsTo(Country::class, 'country_id','id');
    }

    static function boot(){
        parent::boot();

        static::created(function(Model $model){
            if($model->role_id == ""){
                $model->update([
                    'role_id' => Role::where('role_name','user')->first()->id,
                ]);
            }
        });

    }
}
