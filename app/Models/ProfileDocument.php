<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileDocument extends Model
{
    use HasFactory;
    public function profile ()
    {
        return $this->belongsTo(Profile::class, 'profile_id');
    }

    public function document ()
    {
        return $this->belongsTo(Document::class, 'document_id');
    }
}
