<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimony extends Model
{
    use HasFactory;
    //definations
    protected $connection='mysql';
    
    
    //relationship
    public function profile()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

}
