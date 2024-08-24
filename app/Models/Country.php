<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\Uuids;

class Country extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'countryName',
        'countryCode',
        'author'
    ];

    public const VALIDATION_RULES = [
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       //
    ];

    public function user(){
        return $this->belongsTo(User::class,'author','id');
    }

    static function boot(){
        parent::boot();

        static::created(function(Model $model){
            if($model->author == ""){
                $model->update([
                    'author' => auth()->id(),
                ]);
            }
        });

    }
}
