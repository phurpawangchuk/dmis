<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Scholarship extends Model
{
    use HasFactory;
    
    protected $dates = ['open_date', 'close_date'];

    public function scholarshipapplication()
    {
        return $this->hasMany(Application::class, 'scholarship_id');
    }

    public function scholarshipresult()
    {
        return $this->hasMany(Result::class, 'scholarship_id');
    }

    public function scholarshipsponser ()
    {
        return $this->hasMany(ScholarshipSponser::class, 'scholarship_id');
    }

    public function sponser()
    {
        return $this->belongstomany(Sponser::class,'sponser_id');
    }
    

    public function getOpendateAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }
    public function getClosedateAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }
}
