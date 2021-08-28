<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function services(){
        return $this->hasMany(Service::class);
    }

    // ha molti renewals attraverso i services
    public function renewals()
    {
        return $this->hasManyThrough(Renewal::class, Service::class);
    }

    public function scopeServicesExpiring($query)
    {
        return $query->whereHas('services.renewalsExpiring')->with([
            'services' => function($q){
                $q->whereHas('renewalsExpiring')->with('serviceType', 'renewalsExpiring');
            }
        ]);
    }
}
