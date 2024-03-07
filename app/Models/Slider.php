<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Slider extends Authenticatable
{
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'filename',
        'author',
    ];

    public const VALIDATION_RULES = [
        'title'    => 'required',
        'filename'     => [
                        'required',
                        'max:2080',
                        ],
    ];


    public function country(){
        return $this->belongsTo(Country::class, 'country_id','id');
    }

    static function boot(){
        parent::boot();
    }
}
