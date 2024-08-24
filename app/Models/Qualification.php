<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;
    protected $connection='mysql';

    //relationship
    public function profilequalification()
    {
        return $this->hasMany(ProfileQualification::class, 'qualification_id');
    }

    public function profile ()
    {
        return $this->belongsToMany(Profile::class);
    }
   /* public function institute()
    {
        return $this->belongsTo(Institute::class, 'institute_id');
    }*/
    
}
