<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'author', 'event_name', 'event_date','description'
    ];

    public const VALIDATION_RULES = [
        'event_name' => [
                    'required',
                ],
        'event_date' => [
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