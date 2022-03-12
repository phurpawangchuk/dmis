<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class Post extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'author',
        'dated',
    ];

    public const VALIDATION_RULES = [
        'title' => [
                    'required',
                    'max:250',
                    //'unique:posts',
                    ]
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       //
    ];
  
    public function getAuthorName($author){
        $author = User::where('id','=',$author)->get();
        return $author[0]['name'];
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
