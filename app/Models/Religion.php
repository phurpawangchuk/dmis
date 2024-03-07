<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    protected $fillable = [
        'author', 'name', 'description'
    ];

    public const VALIDATION_RULES = [
        'name' => [
                    'required',
                ],
        'description' => [
            'required',
        ],
    ];

    public function user(){
        return $this->belongsTo(User::class,'author','id');
    }

}