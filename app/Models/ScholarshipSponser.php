<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScholarshipSponser extends Model
{
    use HasFactory;

    public function scholarship()
    {
        return $this->belongsto(Scholarship::class,'scholar_id');
    }
    public function sponser ()
    {
        return $this->belongsto(Sponser::class,'sponser_id');
    }
}
