<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sponser extends Model
{
    use HasFactory;

    public function sponserscholarship()
    {
        return $this->hasMany(ScholarshipSponser::class, 'sponser_id');
    }
}
