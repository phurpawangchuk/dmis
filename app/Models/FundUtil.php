<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class FundUtil extends Authenticatable
{
    protected $table = 'fund_utilization';
    use HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'donor_id',
        'project_id',
        'amount_used',
        'shortCode',
        'util_report',
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

    public function profile(){
        return $this->belongsTo(UserProfile::class,'author','id');
    }

    public function project(){
        return $this->belongsTo(ProjectMaster::class,'project_id','id');
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
