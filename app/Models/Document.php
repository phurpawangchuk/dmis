<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Document extends Model
{
    use HasFactory;
    public function profiledocument()
    {
        return $this->hasMany(ProfileDocument::class, 'document_id');
    }

    public function profile ()
    {
        return $this->belongsToMany(Profile::class);
    }
}
