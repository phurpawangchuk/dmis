<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_name',
        'short_code',
    ];

    public const VALIDATION_RULES = [
        'role_name' => [
                    'required', 
                    'unique:roles',
                   ],
        'permissions' => 'required|array',
    ];

    public function permissions(){
        return $this->belongsToMany('App\Models\Permission', 'role_permissions',  'role_id', 'permission_id');
    }

    static function boot(){

        parent::boot();

        static::deleting(function (Model $model){
           User::where('role_id', $model->id)->update(['role_id' => null]);
        });
    }
}
