<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    //declaration
    protected $connection='ydfmaster';
    
    

    //relationships
    public function gewog()
    {
        return $this->belongsTo(Gewog::class, 'gewog_id');
    }

}
