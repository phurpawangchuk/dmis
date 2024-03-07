<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProfileQualification extends Model
{
    use HasFactory;
   
    public function profile ()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function qualification ()
    {
        return $this->belongsTo(Qualification::class, 'qualification_id');
    }
}
