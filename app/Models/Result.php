<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    public function scholarship()
    {
        return $this->belongsto(Scholarship::class,'scholarship_id');
    }

    public function profile ()
    {
        return $this->belongsto(Profile::class,'profile_id');
    }
}
