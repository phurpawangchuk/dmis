<?php
namespace App\Traits;
use Illuminate\Support\Str;

trait Uuids
{

    protected static function bootUsesUuid() {
        
        static::creating(function ($model) {
        if (! $model->uuid) {
            $model->uuid = (string) Str::uuid();
            }
        });
    }

    // protected static function bootUsesUuid()
    // {
    //     static::creating(function ($model) {
    //         if (! $model->getKey()) {
    //             $model->{$model->getKeyName()} = (string) Str::uuid();
    //         }
    //     });
    // }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}