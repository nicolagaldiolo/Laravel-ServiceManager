<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    protected $guarded = [];

    // appartiene ad un User
    public function user(){
        return $this->belongsTo(User::class);
    }

    // Ha molti Services
    public function services(){
        return $this->hasMany(Service::class);
    }
}
