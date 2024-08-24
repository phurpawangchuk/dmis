<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model
{
    protected $fillable = [
        'donor_id',
        'amount',
        'project_id',
        'paymentoption',
        'orderNo',
        'payment_date',
        'payment_status',
        'is_verified',
        'actualamount',
        'bank',
        'jrn'
    ];

    protected $hidden = [
        'amount',
        'orderNo',
    ];

    public const VALIDATION_RULES = [
        'donor_id' => [
                    'required',
                ],
        'amount' => [
                    'required',
        ],
        'project_id' => [
            'required',
        ],
        // 'paymentoption' => [
        //     'required',
        // ],
    ];

    public function user(){
        return $this->belongsTo(User::class,'donor_id','id');
    }

    public function profile(){
        return $this->belongsTo(UserProfile::class,'user_id','id');
    }

    public function paymentmode(){
        return $this->belongsTo(PaymentMaster::class, 'paymentoption','id');
    }

    public function project(){
        return $this->belongsTo(ProjectMaster::class, 'project_id','id');
    }
}
