<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UserProfile extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address',
        'company',
        'contactno',
        //'author',
        'status',
        'document_id',
        'country',
        'nationality',
        'religion'
    ];

    public const VALIDATION_RULES = [
        'name'      => 'required|string|min:2|max:200',
        // 'avatar'    => 'required|image',

        // 'email'     => [
        //                 'required',
        //                 'max:200',
                        // 'email',
                        // 'unique:users',
                        // ],
        // 'role_id'   => 'required|exists:roles,id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    static function boot(){
        parent::boot();
    }
}
