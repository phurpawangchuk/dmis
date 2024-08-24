<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;
    protected $connection='mysql';

    protected $dates = ['dob'];

    //relation

    public function dzongkhag()
    {
        return $this->belongsTo(Dzongkhag::class, 'p_dzongkhag_id');
    }

    public function gewog()
    {
        return $this->belongsTo(Gewog::class, 'p_gewog_id');
    }
    public function village()
    {
        return $this->belongsTo(Village::class, 'p_village_id');
    }
    
    public function current_dzongkhag()
    {
        return $this->belongsTo(Dzongkhag::class, 'c_dzongkhag_id');
    }

    public function current_gewog()
    {
        return $this->belongsTo(Gewog::class, 'c_gewog_id');
    }
    public function current_village()
    {
        return $this->belongsTo(Village::class, 'c_village_id');
    }

    public function qualification ()
    {
        return $this->belongsToMany(Qualification::class);
    }
    public function document ()
    {
        return $this->belongsToMany(Document::class);
    }

    public function profileapplication ()
    {
        return $this->hasMany(Application::class,'profile_id');
    }

    public function profileresult ()
    {
        return $this->hasMany(Result::class,'profile_id');
    }



    public function getDobAttribute($value)
    {
        return $value ? date('d-m-Y', strtotime($value)) : null;
    }
    

}
